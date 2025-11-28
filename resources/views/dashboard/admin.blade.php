@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    /* Stat Cards */
    .modern-stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: clamp(20px, 5vw, 25px);
        color: white;
        border: none;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .modern-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
    }

    .modern-stat-card h6 {
        font-size: clamp(12px, 2.5vw, 14px);
        font-weight: 500;
        opacity: 0.9;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modern-stat-card h6 i {
        font-size: clamp(14px, 3vw, 16px);
        margin-right: 8px;
    }

    .modern-stat-number {
        font-size: clamp(28px, 8vw, 36px);
        font-weight: bold;
        margin: 10px 0;
    }

    .modern-stat-card small {
        font-size: clamp(11px, 2vw, 12px);
        opacity: 0.85;
        margin-top: auto;
    }

    /* Chart Cards */
    .modern-chart-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .modern-chart-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px 12px 0 0;
        color: white;
        padding: clamp(15px, 4vw, 20px);
    }

    .modern-chart-header h5 {
        margin-bottom: 0;
        font-size: clamp(16px, 3vw, 18px);
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
        min-height: 250px;
        padding: clamp(15px, 3vw, 20px);
    }

    canvas {
        max-height: 250px;
    }

    /* Stats Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: clamp(12px, 3vw, 20px);
        margin-bottom: clamp(20px, 5vw, 30px);
    }

    /* Charts Row */
    .charts-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: clamp(12px, 3vw, 20px);
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

<div class="stats-row">
    <div>
        <div class="modern-stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h6><i class="bi bi-people-fill"></i> Total Siswa</h6>
            <div class="modern-stat-number">{{ $totalSiswa }}</div>
            <small>Siswa terdaftar dalam sistem</small>
        </div>
    </div>
    <div>
        <div class="modern-stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <h6><i class="bi bi-door-closed"></i> Total Kelas</h6>
            <div class="modern-stat-number">{{ $totalKelas }}</div>
            <small>Kelas aktif dalam sistem</small>
        </div>
    </div>
    <div>
        <div class="modern-stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <h6><i class="bi bi-clipboard-check"></i> Absensi Hari Ini</h6>
            <div class="modern-stat-number">{{ $absensiHariIni }}</div>
            <small>Data absensi tercatat</small>
        </div>
    </div>
</div>

<div class="charts-row">
    <div>
        <div class="modern-chart-card">
            <div class="card-header modern-chart-header">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Status Absensi (Bulan Ini)</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
    <div>
        <div class="modern-chart-card">
            <div class="card-header modern-chart-header">
                <h5 class="mb-0"><i class="bi bi-graph-up"></i> Trend Absensi (Bulan Ini)</h5>
            </div>
            <div class="card-body">
                <canvas id="perHariChart"></canvas>
            </div>
        </div>
    </div>
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
                @foreach($perHari as $item)
                {{ \Carbon\Carbon::parse($item->tanggal)->format("d-m") }}
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Absensi',
                data: [
                    @foreach($perHari as $item)
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
