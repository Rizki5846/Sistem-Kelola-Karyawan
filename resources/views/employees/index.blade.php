
@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('page-title', 'Data Karyawan')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data Karyawan</h4>
            <p class="text-muted mb-0">
                Kelola informasi karyawan perusahaan.
            </p>
        </div>

        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Tambah Karyawan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="content-card">
        <form action="{{ route('employees.index') }}" method="GET"
            class="row g-2 mb-4">
            <div class="col-12 col-md-8">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    value="{{ $search }}"
                    placeholder="Cari nama, nomor karyawan, atau email..."
                >
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    Cari
                </button>
            </div>

            <div class="col-auto">
                <a href="{{ route('employees.index') }}"
                    class="btn btn-outline-secondary">
                    Reset
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>No. Karyawan</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>
                                {{ $employees->firstItem() + $loop->index }}
                            </td>
                            <td>{{ $employee->employee_number }}</td>
                            <td>
                                <div class="fw-semibold">
                                    {{ $employee->name }}
                                </div>
                                <small class="text-muted">
                                    {{ $employee->email ?? '-' }}
                                </small>
                            </td>
                            <td>{{ $employee->department?->name ?? '-' }}</td>
                            <td>{{ $employee->position?->name ?? '-' }}</td>
                            <td>
                                @php
                                    $statusClass = match ($employee->employment_status) {
                                        'active' => 'success',
                                        'inactive' => 'warning',
                                        'resigned' => 'secondary',
                                        default => 'light',
                                    };

                                    $statusLabel = match ($employee->employment_status) {
                                        'active' => 'Aktif',
                                        'inactive' => 'Tidak Aktif',
                                        'resigned' => 'Resign',
                                        default => $employee->employment_status,
                                    };
                                @endphp

                                <span class="badge text-bg-{{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('employees.edit', $employee) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('employees.destroy', $employee) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus karyawan ini? Data terkait juga dapat terhapus.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="fw-semibold">
                                    Data karyawan belum tersedia
                                </div>
                                <small class="text-muted">
                                    Tambahkan karyawan atau ubah kata pencarian.
                                </small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
