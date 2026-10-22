
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            {{ $isHrd ? 'Data Absensi Karyawan' : 'Absensi Saya' }}
        </h4>
        <p class="text-muted mb-0">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (isset($accountError))
        <div class="alert alert-warning">{{ $accountError }}</div>
    @endif

    @if (!$isHrd && $employee)
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <p class="text-muted mb-1">Waktu Check-in</p>
                        <h3 class="fw-bold">
                            {{ $todayAttendance?->check_in ?? '--:--:--' }}
                        </h3>

                        @if (!$todayAttendance)
                            <form action="{{ route('attendances.check-in') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    Check-in Sekarang
                                </button>
                            </form>
                        @else
                            <span class="badge bg-success">Sudah Check-in</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <p class="text-muted mb-1">Waktu Check-out</p>
                        <h3 class="fw-bold">
                            {{ $todayAttendance?->check_out ?? '--:--:--' }}
                        </h3>

                        @if ($todayAttendance && !$todayAttendance->check_out)
                            <form action="{{ route('attendances.check-out') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    Check-out Sekarang
                                </button>
                            </form>
                        @elseif ($todayAttendance?->check_out)
                            <span class="badge bg-secondary">Sudah Check-out</span>
                        @else
                            <span class="text-muted small">Silakan check-in terlebih dahulu.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Riwayat Absensi</h5>

            @if ($isHrd)
                <form method="GET" action="{{ route('attendances.index') }}"
                      class="row g-2 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Cari nama atau nomor karyawan">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="date" class="form-control"
                               value="{{ request('date') }}">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary">Filter</button>
                        <a href="{{ route('attendances.index') }}"
                           class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            @if ($isHrd)
                                <th>No. Karyawan</th>
                                <th>Nama Karyawan</th>
                            @endif
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->attendance_date->format('d-m-Y') }}</td>

                                @if ($isHrd)
                                    <td>{{ $attendance->employee?->employee_number ?? '-' }}</td>
                                    <td>{{ $attendance->employee?->name ?? '-' }}</td>
                                @endif

                                <td>{{ $attendance->check_in ?? '-' }}</td>
                                <td>{{ $attendance->check_out ?? '-' }}</td>
                                <td>
                                    @if ($attendance->check_in && $attendance->check_out)
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif ($attendance->check_in)
                                        <span class="badge bg-warning text-dark">Sedang Bekerja</span>
                                    @else
                                        <span class="badge bg-secondary">Belum Hadir</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isHrd ? 6 : 4 }}"
                                    class="text-center text-muted py-4">
                                    Belum ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection
