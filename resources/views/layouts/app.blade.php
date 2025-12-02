<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Aplikasi Absensi Kelas') - Absensi Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">
    <link rel="stylesheet" href="{{ asset('css/responsive-utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 250px;
            padding: 0;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: clamp(15px, 3vw, 20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: clamp(16px, 3vw, 18px);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .sidebar-brand i {
            font-size: clamp(18px, 3vw, 22px);
        }

        .sidebar-nav {
            padding: 0 clamp(10px, 2vw, 15px);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: clamp(10px, 2vw, 12px) clamp(12px, 2vw, 20px);
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: clamp(13px, 2vw, 14px);
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .nav-link i {
            font-size: clamp(16px, 2.5vw, 18px);
            min-width: 20px;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(5px);
        }

        .nav-divider {
            border-color: rgba(255, 255, 255, 0.1) !important;
            margin: clamp(12px, 2vw, 20px) 0;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: clamp(12px, 2vw, 15px) clamp(15px, 3vw, 25px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: clamp(12px, 3vw, 20px);
            flex-wrap: wrap;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: clamp(8px, 2vw, 12px);
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: #667eea;
            font-size: 24px;
            cursor: pointer;
            padding: 5px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            transform: scale(1.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: clamp(8px, 2vw, 12px);
        }

        .user-info .navbar-brand {
            color: #333;
            font-size: clamp(14px, 2vw, 16px);
            margin: 0;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-badge {
            padding: clamp(4px, 1vw, 6px) clamp(8px, 2vw, 12px);
            font-size: clamp(11px, 1.8vw, 12px);
            font-weight: 600;
            border-radius: 6px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        /* Content */
        .content {
            flex: 1;
            overflow-y: auto;
            padding: clamp(15px, 4vw, 25px);
            -webkit-overflow-scrolling: touch;
        }

        /* Alerts */
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: clamp(15px, 3vw, 20px);
            padding: clamp(12px, 2vw, 15px) clamp(15px, 3vw, 20px);
            font-size: clamp(13px, 2vw, 14px);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .alert li {
            margin-bottom: 4px;
            font-size: clamp(12px, 1.8vw, 13px);
        }

        /* Cards */
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        /* Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: clamp(15px, 3vw, 20px);
            border-radius: 10px;
            margin-bottom: clamp(15px, 3vw, 20px);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h5 {
            font-weight: bold;
            font-size: clamp(14px, 2vw, 16px);
            margin-bottom: 10px;
        }

        .stat-card .stat-number {
            font-size: clamp(24px, 6vw, 32px);
            font-weight: bold;
        }

        /* Badges */
        .badge {
            padding: clamp(4px, 1vw, 6px) clamp(8px, 2vw, 12px);
            font-size: clamp(11px, 1.8vw, 12px);
            border-radius: 6px;
        }

        .badge-primary {
            background-color: #667eea;
        }

        .badge-hadir {
            background-color: #28a745;
        }

        .badge-sakit {
            background-color: #ffc107;
            color: black;
        }

        .badge-izin {
            background-color: #17a2b8;
        }

        .badge-alpa {
            background-color: #dc3545;
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar,
        .content::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-track,
        .content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb,
        .content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover,
        .content::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Tablet Responsiveness */
        @media (max-width: 992px) {
            .app-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                max-height: 60px;
                padding: 0;
                overflow: visible;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar-brand {
                border: none;
                margin: 0;
                padding: 0 clamp(12px, 3vw, 20px);
                border-right: 1px solid rgba(255, 255, 255, 0.1);
                min-width: 200px;
            }

            .sidebar-nav {
                display: flex;
                gap: 5px;
                overflow-x: auto;
                padding: 0 clamp(10px, 2vw, 15px);
                -webkit-overflow-scrolling: touch;
                flex: 1;
            }

            .nav-link {
                margin: 0;
                padding: clamp(8px, 1.5vw, 10px) clamp(10px, 2vw, 15px);
                white-space: nowrap;
                flex-shrink: 0;
            }

            .nav-divider {
                display: none;
            }

            .nav-link form {
                display: inline;
            }

            .logout-link {
                padding: clamp(8px, 1.5vw, 10px) clamp(10px, 2vw, 15px) !important;
            }

            .main-content {
                width: 100%;
            }
        }

        /* Mobile Responsiveness */
        @media (max-width: 576px) {
            .app-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                max-height: 50px;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar-brand {
                padding: 0 clamp(10px, 2vw, 15px);
                border: none;
                border-right: 1px solid rgba(255, 255, 255, 0.1);
                margin: 0;
                font-size: 14px;
                min-width: auto;
                flex-shrink: 0;
            }

            .sidebar-brand i {
                display: none;
            }

            .sidebar-nav {
                display: flex;
                gap: 2px;
                overflow-x: auto;
                padding: 0 clamp(5px, 1vw, 10px);
                flex: 1;
            }

            .nav-link {
                padding: clamp(6px, 1.5vw, 8px) clamp(8px, 1.5vw, 12px) !important;
                margin: 0;
                font-size: 12px;
                min-width: 45px;
                justify-content: center;
            }

            .nav-link i {
                min-width: auto;
                margin-right: 0;
            }

            .nav-text {
                display: none;
            }

            .sidebar-toggle {
                display: block;
                padding: 0 clamp(10px, 2vw, 15px);
            }

            .top-navbar {
                padding: clamp(10px, 2vw, 12px) clamp(12px, 2vw, 15px);
                flex-direction: row;
            }

            .user-info {
                gap: 6px;
            }

            .user-info .navbar-brand {
                font-size: 12px;
                gap: 4px;
            }

            .user-badge {
                padding: 3px 6px;
                font-size: 10px;
            }

            .content {
                padding: clamp(10px, 2vw, 15px);
            }

            .card-body {
                padding: clamp(12px, 2vw, 15px);
            }
        }

        /* Extra Small Devices */
        @media (max-width: 360px) {
            .sidebar-brand {
                font-size: 12px;
            }

            .nav-link {
                min-width: 40px;
                padding: 6px 6px !important;
            }

            .top-navbar {
                padding: 8px 10px;
            }

            .content {
                padding: 10px;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <i class="bi bi-calendar-check"></i>
                <span class="brand-text">Absensi</span>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
                    <i class="bi bi-speedometer2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('kelas.index') }}"
                        class="nav-link {{ request()->routeIs('kelas.*') ? 'active' : '' }}" title="Kelas">
                        <i class="bi bi-door-closed"></i>
                        <span class="nav-text">Kelas</span>
                    </a>
                    <a href="{{ route('siswa.index') }}"
                        class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}" title="Siswa">
                        <i class="bi bi-people-fill"></i>
                        <span class="nav-text">Siswa</span>
                    </a>
                @endif

                <a href="{{ route('absensi.index') }}"
                    class="nav-link {{ request()->routeIs('absensi.*') ? 'active' : '' }}" title="Absensi">
                    <i class="bi bi-clipboard-check"></i>
                    <span class="nav-text">Absensi</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="display: inline; width: 100%;">
                    @csrf
                    <button type="submit" class="nav-link logout-link" title="Logout"
                        style="border: none; background: none; cursor: pointer; text-align: left; width: 100%;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="nav-text">Logout</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <nav class="top-navbar">
                <div class="navbar-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <div class="user-info">
                    <div class="navbar-brand">
                        <i class="bi bi-person-circle"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <span class="user-badge">
                        {{ auth()->user()->role === 'admin' ? 'Admin' : 'Guru' }}
                    </span>
                </div>
            </nav>

            <div class="content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi Kesalahan:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        function toggleSidebar() {
            // Toggle functionality dapat ditambahkan jika diperlukan
            console.log('Sidebar toggle');
        }
    </script>
    @yield('scripts')
</body>

</html>
