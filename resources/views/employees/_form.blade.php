
@php
    $isEdit = isset($employee);
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa kembali data yang kamu masukkan:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-12 col-md-6">
        <label class="form-label">Nomor Karyawan *</label>
        <input
            type="text"
            name="employee_number"
            class="form-control"
            value="{{ old('employee_number', $employee->employee_number ?? '') }}"
            required
        >
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Nama Lengkap *</label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $employee->name ?? '') }}"
            required
        >
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Email</label>
        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email', $employee->email ?? '') }}"
        >
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Nomor Telepon</label>
        <input
            type="text"
            name="phone"
            class="form-control"
            value="{{ old('phone', $employee->phone ?? '') }}"
        >
    </div>

    <div class="col-12">
        <label class="form-label">Alamat</label>
        <textarea
            name="address"
            class="form-control"
            rows="3"
        >{{ old('address', $employee->address ?? '') }}</textarea>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Departemen</label>
        <select name="department_id" class="form-select">
            <option value="">-- Pilih Departemen --</option>
            @foreach ($departments as $department)
                <option
                    value="{{ $department->id }}"
                    @selected((string) old('department_id', $employee->department_id ?? '') === (string) $department->id)
                >
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Jabatan</label>
        <select name="position_id" class="form-select">
            <option value="">-- Pilih Jabatan --</option>
            @foreach ($positions as $position)
                <option
                    value="{{ $position->id }}"
                    @selected((string) old('position_id', $employee->position_id ?? '') === (string) $position->id)
                >
                    {{ $position->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Atasan Langsung</label>
        <select name="manager_id" class="form-select">
            <option value="">-- Tidak ada / Belum ditentukan --</option>
            @foreach ($managers as $manager)
                <option
                    value="{{ $manager->id }}"
                    @selected((string) old('manager_id', $employee->manager_id ?? '') === (string) $manager->id)
                >
                    {{ $manager->name }} ({{ $manager->employee_number }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Tanggal Bergabung</label>
        <input
            type="date"
            name="join_date"
            class="form-control"
            value="{{ old('join_date', isset($employee?->join_date) ? $employee->join_date->format('Y-m-d') : '') }}"
        >
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Tanggal Lahir</label>
        <input
            type="date"
            name="birth_date"
            class="form-control"
            value="{{ old('birth_date', isset($employee?->birth_date) ? $employee->birth_date->format('Y-m-d') : '') }}"
        >
    </div>

    <div class="col-12 col-md-6">
        <label class="form-label">Status Karyawan *</label>
        <select name="employment_status" class="form-select" required>
            <option value="active"
                @selected(old('employment_status', $employee->employment_status ?? 'active') === 'active')>
                Aktif
            </option>
            <option value="inactive"
                @selected(old('employment_status', $employee->employment_status ?? '') === 'inactive')>
                Tidak Aktif
            </option>
            <option value="resigned"
                @selected(old('employment_status', $employee->employment_status ?? '') === 'resigned')>
                Resign
            </option>
        </select>
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-primary">
        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Karyawan' }}
    </button>

    <a href="{{ route('employees.index') }}"
        class="btn btn-outline-secondary">
        Batal
    </a>
</div>
