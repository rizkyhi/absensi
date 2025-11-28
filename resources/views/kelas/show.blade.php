@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
<style>
    /* Page Header */
    .page-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: clamp(12px, 3vw, 20px);
        margin-bottom: clamp(20px, 5vw, 30px);
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .page-header h2 {
        font-size: clamp(24px, 6vw, 32px);
        font-weight: 700;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
        min-width: 200px;
    }

    .page-header i {
        font-size: clamp(24px, 6vw, 32px);
        color: #667eea;
    }

    /* Card Styling */
    .info-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
        margin-bottom: clamp(15px, 3vw, 25px);
    }

    .info-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: clamp(12px, 2vw, 15px) clamp(15px, 3vw, 20px);
        border: none !important;
    }

    .card-header h5 {
        font-size: clamp(16px, 3vw, 18px);
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-body {
        padding: clamp(15px, 4vw, 25px);
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: clamp(15px, 3vw, 25px);
    }

    .info-item {
        padding: clamp(12px, 2vw, 15px);
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: #f0f4ff;
        transform: translateY(-2px);
    }

    .info-item p {
        margin: 0;
        line-height: 1.6;
    }

    .info-item strong {
        display: block;
        color: #667eea;
        font-size: clamp(12px, 2vw, 13px);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .info-item-value {
        color: #333;
        font-size: clamp(14px, 2vw, 16px);
        font-weight: 500;
    }

    /* Button Styles */
    .btn {
        padding: clamp(8px, 1.5vw, 10px) clamp(12px, 2vw, 16px);
        font-weight: 600;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: clamp(13px, 2vw, 14px);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-secondary {
        background: #e9ecef;
        color: #666;
    }

    .btn-secondary:hover {
        background: #dee2e6;
        color: #333;
        transform: translateY(-2px);
    }

    .btn i {
        font-size: clamp(12px, 2vw, 14px);
    }

    /* Badge */
    .badge {
        padding: clamp(4px, 1vw, 6px) clamp(8px, 2vw, 12px);
        font-size: clamp(11px, 1.8vw, 12px);
        font-weight: 500;
        border-radius: 6px;
    }

    .bg-info {
        background-color: #17a2b8 !important;
        color: white;
    }

    /* Table Styling */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #e0e0e0;
    }

    .table thead th {
        color: #667eea;
        padding: clamp(10px, 2vw, 15px);
        font-weight: 600;
        font-size: clamp(12px, 2vw, 13px);
        border: none;
        text-align: left;
    }

    .table tbody td {
        padding: clamp(10px, 2vw, 15px);
        border-bottom: 1px solid #e0e0e0;
        font-size: clamp(12px, 2vw, 14px);
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Mobile Optimizations */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header h2 {
            width: 100%;
        }

        .btn-secondary {
            width: 100%;
            justify-content: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .table-wrapper {
            margin: 0 -15px;
        }

        .table thead {
            display: none;
        }

        .table,
        .table tbody,
        .table tr,
        .table td {
            display: block;
            width: 100%;
        }

        .table tbody tr {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: clamp(12px, 2vw, 15px);
            margin-bottom: clamp(12px, 2vw, 15px);
            overflow: hidden;
        }

        .table tbody td {
            padding: clamp(8px, 2vw, 12px) 0;
            border: none;
            text-align: left;
            position: relative;
            padding-left: 50%;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody td:last-child {
            border: none;
        }

        .table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: clamp(8px, 2vw, 12px);
            font-weight: 600;
            width: 45%;
            color: #667eea;
            font-size: clamp(11px, 1.8vw, 12px);
        }

        .table tbody td:first-child {
            font-weight: 700;
            background: #f8f9fa;
            padding-left: clamp(8px, 2vw, 12px);
        }
    }

    @media (max-width: 480px) {
        .card-body {
            padding: 12px;
        }

        .info-item {
            padding: 10px;
        }

        .table tbody td {
            padding: 8px 0;
            padding-left: 45%;
        }

        .btn {
            padding: 8px 10px;
            font-size: 12px;
        }

        .badge {
            padding: 4px 8px;
            font-size: 10px;
        }
    }

    @media (max-width: 360px) {
        .page-header h2 {
            font-size: 20px;
        }

        .card-header h5 {
            font-size: 14px;
        }

        .card-body {
            padding: 10px;
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

    .info-card {
        animation: fadeInUp 0.5s ease;
    }

    .info-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .info-card:nth-child(2) {
        animation-delay: 0.2s;
    }
</style>

<div class="page-header">
    <h2><i class="bi bi-door-closed"></i> Detail Kelas: {{ $kelas->nama_kelas }}</h2>
    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="info-card card">
    <div class="card-header">
        <h5><i class="bi bi-info-circle"></i> Informasi Kelas</h5>
    </div>
    <div class="card-body">
        <div class="info-grid">
            <div class="info-item">
                <strong><i class="bi bi-door-closed"></i> Nama Kelas</strong>
                <div class="info-item-value">{{ $kelas->nama_kelas }}</div>
            </div>
            <div class="info-item">
                <strong><i class="bi bi-ladder"></i> Tingkat</strong>
                <div class="info-item-value">{{ $kelas->tingkat }}</div>
            </div>
            <div class="info-item">
                <strong><i class="bi bi-briefcase"></i> Jurusan</strong>
                <div class="info-item-value">{{ $kelas->jurusan ?? '-' }}</div>
            </div>
            <div class="info-item">
                <strong><i class="bi bi-person"></i> Guru Pengampu</strong>
                <div class="info-item-value">{{ $kelas->guru->nama_lengkap ?? '-' }}</div>
            </div>
            <div class="info-item">
                <strong><i class="bi bi-people"></i> Kapasitas</strong>
                <div class="info-item-value">{{ $kelas->kapasitas }} siswa</div>
            </div>
            <div class="info-item">
                <strong><i class="bi bi-people-fill"></i> Jumlah Siswa</strong>
                <div class="info-item-value">
                    <span class="badge bg-info">{{ $kelas->siswas->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="info-card card">
    <div class="card-header">
        <h5><i class="bi bi-list-check"></i> Daftar Siswa</h5>
    </div>
    <div class="card-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas->siswas as $key => $siswa)
                    <tr>
                        <td data-label="No">{{ $key + 1 }}</td>
                        <td data-label="NIS"><strong>{{ $siswa->nis }}</strong></td>
                        <td data-label="Nama Lengkap">{{ $siswa->nama_lengkap }}</td>
                        <td data-label="Jenis Kelamin">{{ $siswa->jenis_kelamin }}</td>
                        <td data-label="Tanggal Lahir">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                        <td data-label="Alamat">{{ $siswa->alamat ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada siswa di kelas ini</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
