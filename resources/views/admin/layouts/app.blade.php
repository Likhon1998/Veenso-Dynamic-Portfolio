<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Veenso</title>
    @php $adminFavVersion = @filemtime(public_path('favicon-48x48.png')) ?: time(); @endphp
    <link rel="icon" href="{{ asset('favicon-48x48.png') }}?v={{ $adminFavVersion }}" type="image/png" sizes="48x48">
    <link rel="icon" href="{{ asset('favicon-192x192.png') }}?v={{ $adminFavVersion }}" type="image/png" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v={{ $adminFavVersion }}" sizes="180x180">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ $adminFavVersion }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ @filemtime(public_path('css/admin.css')) ?: time() }}">
    @stack('styles')
</head>
<body class="admin-body">
    <div class="admin-shell">
        @include('admin.partials._sidebar')

        <div class="main-area">
            @include('admin.partials._topbar')

            <main class="content">
                @include('admin.partials._flash')
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    @stack('scripts')
</body>
</html>
