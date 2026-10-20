
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - HRIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex min-vh-100">
        @include('partials.sidebar')

        <div class="main-content flex-grow-1">
            @include('partials.navbar')

            <main class="container-fluid p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
