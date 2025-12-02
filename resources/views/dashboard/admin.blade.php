@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <style>
        /* Page Header */
        .dashboard-header {
            margin-bottom: clamp(24px, 5vw, 40px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .dashboard-title {
            font-size: clamp(24px, 5vw, 36px);
            font-weight: 800;
            color: #222;
            margin: 0;
        }

        .dashboard-date {
            color: #1531b3ff;
            font-size: 14px;
            font-weight: 600;
        }

        /* Stat Cards */
        .modern-stat-card {
            background: white;
            border-radius: 14px;
            padding: clamp(20px, 5vw, 28px);
            color: #333;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            border-left: 4px solid #667eea;
        }

        .modern-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .modern-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .modern-stat-card h6 {
            font-size: clamp(12px, 2.5vw, 14px);
            font-weight: 600;
            opacity: 0.8;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #667eea;
            position: relative;
            z-index: 1;
        }

        .modern-stat-card h6 i {
            font-size: clamp(14px, 3vw, 16px);
            margin-right: 8px;
        }

        .modern-stat-number {
            font-size: clamp(32px, 8vw, 44px);
            font-weight: 800;
            margin: 8px 0;
            color: #222;
            position: relative;
            z-index: 1;
        }

        .modern-stat-card small {
            font-size: clamp(12px, 2vw, 13px);
            opacity: 0.7;
            margin-top: auto;
            position: relative;
            z-index: 1;
        }

        /* Stat Card dengan gradient border */
        .stat-card-pink {
            border-left-color: #f5576c;
        }

        .stat-card-pink h6 {
            color: #f5576c;
        }

        .stat-card-blue {
            border-left-color: #00f2fe;
        }

        .stat-card-blue h6 {
            color: #00f2fe;
        }

        .stat-card-green {
            border-left-color: #38f9d7;
        }

        .stat-card-green h6 {
            color: #38f9d7;
        }

        /* Chart Cards */
        .modern-chart-card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: white;
            transition: all 0.3s ease;
        }

        .modern-chart-card:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .modern-chart-header {
            background: linear-gradient(135deg, #3954cfff 0%, #6628a3ff 100%);
            border-radius: 14px 14px 0 0;
            color: white;
            padding: clamp(16px, 3vw, 20px);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modern-chart-header h5 {
            margin-bottom: 0;
            font-size: clamp(16px, 3vw, 18px);
            font-weight: 700;
            color: white;
        }

        .modern-chart-header h5 i {
            font-size: clamp(16px, 3.5vw, 18px);
            margin-right: 10px;
        }

        .card-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 280px;
            padding: clamp(16px, 3vw, 24px);
        }

        canvas {
            max-height: 260px;
        }

        /* Stats Row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: clamp(16px, 3vw, 24px);
            margin-bottom: clamp(24px, 5vw, 40px);
        }

        /* Charts Row */
        .charts-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: clamp(16px, 3vw, 24px);
            margin-bottom: clamp(24px, 5vw, 40px);
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-left: 4px solid #667eea;
            border-radius: 8px;
            padding: 16px;
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }

        .info-box i {
            color: #667eea;
            margin-right: 8px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .modern-stat-card {
                padding: 18px;
            }

            .modern-chart-header {
                padding: 15px;
            }

            .card-body {
                min-height: 220px;
                padding: 15px;
            }

            canvas {
                max-height: 220px;
            }

            .stats-row {
                gap: 15px;
                margin-bottom: 20px;
            }

            .charts-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .modern-stat-card {
                padding: 15px;
            }

            .modern-stat-card h6 {
                font-size: 11px;
                margin-bottom: 8px;
            }

            .modern-stat-number {
                font-size: 24px;
                margin: 8px 0;
            }

            .modern-stat-card small {
                font-size: 10px;
            }

            .modern-chart-header {
                padding: 12px;
            }

            .modern-chart-header h5 {
                font-size: 14px;
            }

            .modern-chart-header h5 i {
                font-size: 14px;
                margin-right: 6px;
            }

            .card-body {
                min-height: 200px;
                padding: 12px;
            }

            canvas {
                max-height: 200px;
            }

            .stats-row {
                gap: 12px;
                margin-bottom: 15px;
            }

            .charts-row {
                gap: 12px;
            }
        }

        @media (max-width: 360px) {
            .modern-stat-card {
                padding: 12px;
            }

            .modern-stat-number {
                font-size: 20px;
            }

            .card-body {
                min-height: 180px;
            }

            canvas {
                max-height: 180px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modern-stat-card,
        .modern-chart-card {
            animation: fadeInUp 0.5s ease;
        }

        .modern-stat-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .modern-stat-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .modern-stat-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .modern-chart-card:nth-child(1) {
            animation-delay: 0.4s;
        }

        .modern-chart-card:nth-child(2) {
            animation-delay: 0.5s;
        }
    </style>

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title"><i class="bi bi-speedometer2"></i> Dashboard Admin</h1>
            <p class="dashboard-date">Selamat datang, <strong>{{ Auth::user()->name }}</strong> |
                {{ \Carbon\Carbon::now()->format('l, d F Y') }}</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-row">
        <div class="modern-stat-card stat-card-pink">
            <h6><i class="bi bi-people-fill"></i> Total Siswa</h6>
            <div class="modern-stat-number">{{ $totalSiswa }}</div>
            <small>Siswa terdaftar dalam sistem</small>
        </div>

        <div class="modern-stat-card stat-card-blue">
            <h6><i class="bi bi-door-closed"></i> Total Kelas</h6>
            <div class="modern-stat-number">{{ $totalKelas }}</div>
            <small>Kelas aktif dalam sistem</small>
        </div>

        <div class="modern-stat-card stat-card-green">
            <h6><i class="bi bi-clipboard-check"></i> Absensi Hari Ini</h6>
            <div class="modern-stat-number">{{ $absensiHariIni }}</div>
            <small>Data absensi tercatat hari ini</small>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-row">
        <div class="modern-chart-card">
            <div class="card-header modern-chart-header">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Status Absensi Bulan Ini</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <div class="modern-chart-card">
            <div class="card-header modern-chart-header">
                <h5 class="mb-0"><i class="bi bi-graph-up"></i> Trend Absensi Per Hari</h5>
            </div>
            <div class="card-body">
                <canvas id="perHariChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <i class="bi bi-info-circle"></i>
        <strong>Informasi:</strong> Dashboard ini menampilkan ringkasan data absensi secara realtime. Gunakan menu navigasi
        untuk mengakses fitur lengkap aplikasi.
    </div>

    <script>
        // Chart Status Absensi
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Sakit', 'Izin', 'Alpa'],
                datasets: [{
                    data: [
                        {{ $statusAbsensi['Hadir'] ?? 0 }},
                        {{ $statusAbsensi['Sakit'] ?? 0 }},
                        {{ $statusAbsensi['Izin'] ?? 0 }},
                        {{ $statusAbsensi['Alpa'] ?? 0 }}
                    ],
                    backgroundColor: ['#28a745', '#ffc107', '#17a2b8', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart Absensi Per Hari
        const perHariCtx = document.getElementById('perHariChart').getContext('2d');
        const perHariChart = new Chart(perHariCtx, {
            type: 'line',
            data: {
                labels: [
                    @foreach ($perHari as $item)
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m') }}
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Absensi',
                    data: [
                        @foreach ($perHari as $item)
                            {{ $item->total }},
                        @endforeach
                    ],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
