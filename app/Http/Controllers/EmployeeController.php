<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $employees = Employee::with(['department', 'position', 'manager'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('employee_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('employees.index', compact('employees', 'search'));
    }

    public function create(): View
    {
        return view('employees.create', [
            'departments' => Department::where('is_active', true)
                ->orderBy('name')->get(),
            'positions' => Position::where('is_active', true)
                ->orderBy('name')->get(),
            'managers' => Employee::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_number' => [
                'required', 'string', 'max:50', 'unique:employees,employee_number',
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable', 'email', 'max:255', 'unique:employees,email',
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'department_id' => [
                'nullable', 'integer', 'exists:departments,id',
            ],
            'position_id' => [
                'nullable', 'integer', 'exists:positions,id',
            ],
            'manager_id' => [
                'nullable', 'integer', 'exists:employees,id',
            ],
            'join_date' => ['nullable', 'date'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'employment_status' => [
                'required', Rule::in(['active', 'inactive', 'resigned']),
            ],
        ]);

        if (!empty($validated['manager_id'])) {
            $validated['manager_id'] = (int) $validated['manager_id'];
        }

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit(Employee $employee): View
    {
        return view('employees.edit', [
            'employee' => $employee,
            'departments' => Department::orderBy('name')->get(),
            'positions' => Position::orderBy('name')->get(),
            'managers' => Employee::where('id', '!=', $employee->id)
                ->orderBy('name')->get(),
        ]);
    }

    public function update(
        Request $request,
        Employee $employee
    ): RedirectResponse {
        $validated = $request->validate([
            'employee_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('employees', 'employee_number')
                    ->ignore($employee->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'department_id' => [
                'nullable', 'integer', 'exists:departments,id',
            ],
            'position_id' => [
                'nullable', 'integer', 'exists:positions,id',
            ],
            'manager_id' => [
                'nullable',
                'integer',
                'exists:employees,id',
                Rule::notIn([$employee->id]),
            ],
            'join_date' => ['nullable', 'date'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'employment_status' => [
                'required', Rule::in(['active', 'inactive', 'resigned']),
            ],
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }
}
