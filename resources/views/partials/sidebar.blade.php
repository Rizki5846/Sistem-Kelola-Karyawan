
<aside class="sidebar d-flex flex-column p-3">
    <a href="{{ route('dashboard') }}"
       class="brand text-decoration-none mb-4">
        <span class="brand-icon">H</span>
        <span>HRIS <small>Human Resources</small></span>
    </a>

    <div class="menu-label">MENU UTAMA</div>

    <nav class="nav flex-column gap-1">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="menu-icon">▦</span> Dashboard
        </a>

        <a href="{{ route('employees.index') }}"
            class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
            <span class="menu-icon">♙</span> Data Karyawan
        </a>

        <a href="{{ route('attendances.index') }}"
        class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check me-2">◷</i>
            Absensi
        </a>

        <a href="#" class="nav-link">
            <span class="menu-icon">▤</span> Pengajuan Cuti
        </a>
        <a href="{{ route('positions.index') }}"
        class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}">
            <i class="bi bi-briefcase me-2"></i>
            Jabatan
        </a>

        <a href="{{ route('departments.index') }}"
        class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
            <i class="bi bi-building me-2"></i>
            Departemen
        </a>

        <a href="#" class="nav-link">
            <span class="menu-icon">▥</span> Laporan
        </a>
    </nav>

    <div class="sidebar-footer mt-auto">
        <div class="fw-semibold">HRIS System</div>
        <small>Human Resource Information System</small>
    </div>
</aside>
