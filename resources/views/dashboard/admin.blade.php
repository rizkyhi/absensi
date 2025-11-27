@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
.modern-stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 25px;
    color: white;
    border: none;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
}
.modern-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
}
.modern-stat-card h6 {
    font-size: 14px;
    font-weight: 500;
    opacity: 0.9;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.modern-stat-card h6 i {
    font-size: 16px;
    margin-right: 8px;
}
.modern-stat-number {
    font-size: 36px;
    font-weight: bold;
    margin: 10px 0;
}
.modern-stat-card small {
    font-size: 12px;
    opacity: 0.85;
}
.modern-chart-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}
.modern-chart-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px 12px 0 0;
    color: white;
    padding: 20px;
}
.modern-chart-header h5 i {
    font-size: 18px;
    margin-right: 10px;
}
</style>

<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="modern-stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h6><i class="bi bi-people-fill"></i> Total Siswa</h6>
            <div class="modern-stat-number">{{ $totalSiswa }}</div>
            <small>Siswa terdaftar dalam sistem</small>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="modern-stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <h6><i class="bi bi-door-closed"></i> Total Kelas</h6>
            <div class="modern-stat-number">{{ $totalKelas }}</div>
            <small>Kelas aktif dalam sistem</small>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="modern-stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <h6><i class="bi bi-clipboard-check"></i> Absensi Hari Ini</h6>
            <div class="modern-stat-number">{{ $absensiHariIni }}</div>
            <small>Data absensi tercatat</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="modern-chart-card">
            <div class="card-header modern-chart-header">
                <h5 class="mb-0"><i class="bi bi-pie-chart"></i> Status Absensi (Bulan Ini)</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
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
