
<header class="topbar d-flex align-items-center justify-content-between px-4 py-3">
  
    <div class="d-flex align-items-center gap-3">
        <div class="text-end">
            <div class="fw-semibold">
                {{ auth()->user()->name }}
            </div>
            <small class="text-muted">
                {{ auth()->user()->getRoleNames()->join(', ') ?: 'Belum memiliki role' }}
            </small>
        </div>

        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                Logout
            </button>
        </form>
    </div>

</header>
