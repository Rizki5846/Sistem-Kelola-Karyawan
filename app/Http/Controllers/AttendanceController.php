<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        // HRD dapat melihat absensi seluruh karyawan.
        if ($user->hasRole('HRD')) {
            $attendances = Attendance::with('employee')
                ->when($request->filled('date'), function ($query) use ($request) {
                    $query->whereDate('attendance_date', $request->input('date'));
                })
                ->when($request->filled('search'), function ($query) use ($request) {
                    $search = $request->input('search');

                    $query->whereHas('employee', function ($employeeQuery) use ($search) {
                        $employeeQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('employee_number', 'like', "%{$search}%");
                    });
                })
                ->orderByDesc('attendance_date')
                ->orderByDesc('check_in')
                ->paginate(15)
                ->withQueryString();

            return view('attendances.index', [
                'attendances' => $attendances,
                'todayAttendance' => null,
                'employee' => null,
                'isHrd' => true,
            ]);
        }

        // Karyawan harus terhubung dengan akun login.
        $employee = Employee::where('user_id', $user->id)->first();

        if (!$employee) {
            return view('attendances.index', [
                'attendances' => Attendance::whereRaw('1 = 0')->paginate(15),
                'todayAttendance' => null,
                'employee' => null,
                'isHrd' => false,
                'accountError' => 'Akun Anda belum terhubung dengan data karyawan. Hubungi HRD.',
            ]);
        }

        $todayAttendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('attendance_date', today())
            ->first();

        $attendances = Attendance::where('employee_id', $employee->id)
            ->orderByDesc('attendance_date')
            ->paginate(15);

        return view('attendances.index', compact(
            'attendances',
            'todayAttendance',
            'employee'
        ))->with('isHrd', false);
    }

    public function checkIn(Request $request): RedirectResponse
    {
        $employee = Employee::where('user_id', $request->user()->id)->first();

        if (!$employee) {
            return back()->with('error', 'Akun Anda belum terhubung dengan data karyawan.');
        }

        $now = now();

        try {
            DB::transaction(function () use ($employee, $now) {
                $attendance = Attendance::firstOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'attendance_date' => $now->toDateString(),
                    ],
                    [
                        'check_in' => $now->format('H:i:s'),
                        'status' => 'present',
                    ]
                );

                if (!$attendance->wasRecentlyCreated) {
                    throw new \RuntimeException('Anda sudah melakukan check-in hari ini.');
                }
            });
        } catch (\RuntimeException $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', 'Check-in berhasil dicatat pada ' . $now->format('H:i:s') . '.');
    }

    public function checkOut(Request $request): RedirectResponse
    {
        $employee = Employee::where('user_id', $request->user()->id)->first();

        if (!$employee) {
            return back()->with('error', 'Akun Anda belum terhubung dengan data karyawan.');
        }

        $now = now();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('attendance_date', $now->toDateString())
            ->first();

        if (!$attendance || !$attendance->check_in) {
            return back()->with('error', 'Anda harus check-in terlebih dahulu.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Anda sudah melakukan check-out hari ini.');
        }

        $attendance->update([
            'check_out' => $now->format('H:i:s'),
        ]);

        return back()->with('success', 'Check-out berhasil dicatat pada ' . $now->format('H:i:s') . '.');
    }
}
