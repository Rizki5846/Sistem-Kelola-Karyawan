
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Selamat datang di HRIS</h4>
        <p class="text-muted mb-0">
            Ringkasan informasi karyawan dan aktivitas perusahaan.
        </p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between">
                    <span class="stat-label">Total Karyawan</span>
                    <span class="stat-icon">♙</span>
                </div>
                <div class="stat-value">{{ $totalEmployees }}</div>
                <small class="text-muted">Karyawan terdaftar</small>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between">
                    <span class="stat-label">Hadir Hari Ini</span>
                    <span class="stat-icon">✓</span>
                </div>
                <div class="stat-value">{{ $presentToday }}</div>
                <small class="text-muted">Sudah melakukan check-in</small>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between">
                    <span class="stat-label">Menunggu Persetujuan</span>
                    <span class="stat-icon">◷</span>
                </div>
                <div class="stat-value">{{ $pendingLeaves }}</div>
                <small class="text-muted">Pengajuan cuti</small>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between">
                    <span class="stat-label">Belum Hadir</span>
                    <span class="stat-icon">!</span>
                </div>
                <div class="stat-value">{{ $absentToday }}</div>
                <small class="text-muted">Status sementara</small>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-7">
            <div class="content-card">
                <h6 class="fw-bold mb-3">Aktivitas Sistem</h6>

                <div class="text-center py-5">
                    <div class="fs-1 mb-2">▤</div>
                    <p class="fw-semibold mb-1">Belum ada aktivitas</p>
                    <p class="text-muted mb-0">
                        Aktivitas akan muncul setelah modul HRIS digunakan.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="content-card">
                <h6 class="fw-bold mb-3">Akses Cepat</h6>

                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-primary text-start">
                        + Tambah Karyawan
                    </a>

                    <a href="#" class="btn btn-outline-primary text-start">
                        Lihat Data Absensi
                    </a>

                    <a href="#" class="btn btn-outline-primary text-start">
                        Kelola Pengajuan Cuti
                    </a>
                </div>

                <small class="text-muted d-block mt-3">
                    Tombol akan dihubungkan ke halaman masing-masing
                    setelah modul terkait selesai dibuat.
                </small>
            </div>
        </div>
    </div>
@endsection
