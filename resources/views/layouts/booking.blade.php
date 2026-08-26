<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Booking Aula') - Bapelitbangda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #1E1B4B;
            --indigo: #4F46E5;
            --teal: #0D9488;
            --gold: #CA8A04;
            --bg: #F4F6FB;
            --surface: #FFFFFF;
            --ink: #1E293B;
            --ink-muted: #64748B;
            --line: #E7EAF2;
            --radius: 16px;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--ink);
            font-family: 'Inter', system-ui, sans-serif;
            font-feature-settings: "cv02","cv03","cv04";
        }

        h1, h2, h3, h4, h5, .navbar-brand, .card-title, .fw-display {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* ===== Navbar ===== */
        .app-navbar {
            background: linear-gradient(120deg, var(--navy) 0%, var(--indigo) 55%, var(--teal) 130%);
            box-shadow: 0 8px 24px -12px rgba(30, 27, 75, 0.45);
        }
        .app-navbar .navbar-brand { color: #fff; font-size: 1.15rem; }
        .app-navbar .nav-link { color: rgba(255,255,255,0.82); font-weight: 500; transition: color .15s; }
        .app-navbar .nav-link:hover { color: #fff; }
        .app-navbar .navbar-text { color: rgba(255,255,255,0.85); font-size: 0.9rem; }
        .app-navbar .dropdown-toggle::after { display: none; }
        .app-navbar .menu-btn {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            color: #fff;
            border-radius: 10px;
            padding: 0.5rem 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .app-navbar .menu-btn:hover { background: rgba(255,255,255,0.2); color: #fff; }
        .app-navbar .menu-btn .bar { display: block; width: 18px; height: 2px; background: #fff; border-radius: 2px; }
        .app-navbar .menu-btn .bars { display: flex; flex-direction: column; gap: 3px; }
        .dropdown-menu {
            border-radius: 12px;
            border: 1px solid var(--line);
            box-shadow: 0 16px 32px -12px rgba(30,41,59,0.25);
            padding: 0.5rem;
            min-width: 230px;
        }
        .dropdown-menu .dropdown-item { border-radius: 8px; padding: 0.55rem 0.8rem; font-weight: 500; }
        .dropdown-menu .dropdown-item:hover { background: var(--bg); }
        .dropdown-menu .dropdown-header { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.04em; color: var(--ink-muted); }
        .dropdown-menu .dropdown-item.text-danger:hover { background: #FEE2E2; }

        /* ===== Cards & surfaces ===== */
        .card {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: 0 1px 2px rgba(30,41,59,0.04);
        }
        .card-hover { transition: transform .18s ease, box-shadow .18s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 16px 32px -16px rgba(30,41,59,0.22); }

        .aula-accent-bar { height: 6px; border-radius: var(--radius) var(--radius) 0 0; }

        /* ===== Buttons ===== */
        .btn { border-radius: 10px; font-weight: 600; font-size: 0.92rem; }
        .btn-primary {
            background: linear-gradient(120deg, var(--indigo), var(--teal));
            border: none;
            box-shadow: 0 6px 16px -6px rgba(79,70,229,0.5);
        }
        .btn-primary:hover { background: linear-gradient(120deg, #4338CA, #0F766E); }
        .btn-success { background: #16A34A; border: none; }
        .btn-outline-secondary, .btn-outline-danger, .btn-outline-warning { border-radius: 999px; }

        /* ===== Badges (status) ===== */
        .badge { font-weight: 600; font-size: 0.75rem; padding: 0.4em 0.75em; border-radius: 999px; }
        .badge-pending { background: #FEF3C7; color: #92400E; }
        .badge-approved { background: #DCFCE7; color: #166534; }
        .badge-rejected, .badge-cancelled, .badge-expired { background: #E2E8F0; color: #475569; }

        /* ===== Tables ===== */
        .table { --bs-table-bg: transparent; }
        .table thead th {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--ink-muted);
            border-bottom: 2px solid var(--line);
            background: transparent;
        }
        .table td { vertical-align: middle; border-color: var(--line); }
        .table-wrap { background: var(--surface); border-radius: var(--radius); border: 1px solid var(--line); overflow: hidden; }

        /* ===== Forms ===== */
        .form-control, .form-select {
            border-radius: 10px;
            border-color: var(--line);
            padding: 0.6rem 0.85rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(79,70,229,0.12);
        }
        label.form-label { font-weight: 600; font-size: 0.88rem; color: var(--ink); }

        .alert { border-radius: 12px; border: none; }
        .alert-success { background: #DCFCE7; color: #166534; }
        .alert-danger { background: #FEE2E2; color: #991B1B; }
        .alert-info { background: #E0E7FF; color: #3730A3; }

        .page-heading { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.5rem; }
        .page-heading .eyebrow { color: var(--ink-muted); font-size: 0.85rem; font-weight: 500; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar app-navbar mb-4 py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand mb-0" href="{{ route('aula.index') }}">🏛️ Booking Aula &middot; Bapelitbangda</a>

            <div class="dropdown">
                <button class="menu-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="bars"><span class="bar"></span><span class="bar"></span><span class="bar"></span></span>
                    Menu
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @auth
                        <li><h6 class="dropdown-header">{{ auth()->user()->name }}</h6></li>
                        <li><a class="dropdown-item" href="{{ route('aula.index') }}">Pilih Aula</a></li>
                        <li><a class="dropdown-item" href="{{ route('booking.history') }}">Riwayat Booking Saya</a></li>
                        @if (auth()->user()->isAdmin())
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header">Admin</h6></li>
                            <li><a class="dropdown-item" href="{{ route('admin.booking.index') }}">Kelola Booking</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.surat.index') }}">Agenda Surat</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.aula.index') }}">Kelola Aula</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Daftar</a></li>
                    @endauth
                </ul>
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