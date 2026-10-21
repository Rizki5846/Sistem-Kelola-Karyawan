
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - HRIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-vh-100 d-flex align-items-center justify-content-center p-3">

    <div class="card border-0 shadow-sm w-100" style="max-width: 420px;">
        <div class="card-body p-4 p-md-5">

            <div class="text-center mb-4">
                <div class="brand-icon mx-auto mb-3">H</div>
                <h3 class="fw-bold">HRIS Login</h3>
                <p class="text-muted">
                    Masuk untuk mengakses sistem HRIS
                </p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="nama@perusahaan.com"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <div class="form-check mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                        value="1"
                    >
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">
                    Masuk
                </button>
            </form>

            <p class="text-muted text-center mt-4 mb-0 small">
                HRIS — Human Resource Information System
            </p>
        </div>
    </div>

</body>
</html>
