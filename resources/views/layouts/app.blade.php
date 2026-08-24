<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Booking Aula') - Bapelitbangda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f6f8; }
        .navbar-brand { font-weight: 700; }
        .badge-pending { background: #f59e0b; }
        .badge-approved { background: #16a34a; }
        .badge-rejected, .badge-cancelled, .badge-expired { background: #6b7280; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('aula.index') }}">🏛️ Booking Aula Bapelitbangda</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('aula.index') }}">Pilih Aula</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('booking.history') }}">Riwayat Booking Saya</a></li>
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.booking.index') }}">Kelola Booking</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.surat.index') }}">Agenda Surat</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.aula.index') }}">Kelola Aula</a></li>
                        @endif
                    @endauth
                </ul>
                @auth
                    <span class="navbar-text me-3 text-light">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
