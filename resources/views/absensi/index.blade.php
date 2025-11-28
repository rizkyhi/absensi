@extends('layouts.app')

@section('title', 'Data Absensi')

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

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: clamp(8px, 2vw, 12px);
        align-items: center;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: none;
        margin-bottom: clamp(15px, 3vw, 25px);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .filter-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .filter-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: clamp(12px, 2vw, 15px) clamp(15px, 3vw, 20px);
    }

    .filter-header h5 {
        font-size: clamp(16px, 3vw, 18px);
        font-weight: 600;
        margin: 0;
    }

    .filter-body {
        padding: clamp(15px, 3vw, 20px);
    }

    /* Filter Form */
    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: clamp(12px, 2vw, 15px);
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
        font-size: clamp(13px, 2.5vw, 14px);
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: clamp(8px, 1.5vw, 10px) 12px;
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: #667eea;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Data Card */
    .data-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .data-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .data-card .card-body {
        padding: clamp(15px, 3vw, 20px);
    }

    /* Table Styling */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: clamp(15px, 3vw, 20px);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .table thead th {
        padding: clamp(10px, 2vw, 15px);
        font-weight: 600;
        font-size: clamp(12px, 2vw, 13px);
        text-align: left;
        border: none;
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

    /* Badge Styles */
    .badge {
        padding: clamp(4px, 1vw, 6px) clamp(8px, 2vw, 12px);
        font-size: clamp(10px, 1.8vw, 12px);
        font-weight: 600;
        border-radius: 6px;
        display: inline-block;
    }

    .badge-hadir {
        background-color: #28a745;
        color: white;
    }

    .badge-sakit {
        background-color: #ffc107;
        color: #333;
    }

    .badge-izin {
        background-color: #17a2b8;
        color: white;
    }

    .badge-alpa {
        background-color: #dc3545;
        color: white;
    }

    .badge-info {
        background-color: #667eea;
        color: white;
    }

    /* Button Styles */
    .btn {
        padding: clamp(8px, 1.5vw, 10px) clamp(12px, 2vw, 16px);
        font-weight: 600;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: clamp(12px, 1.8vw, 13px);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #e9ecef;
        color: #666;
    }

    .btn-secondary:hover {
        background: #dee2e6;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .btn i {
        font-size: clamp(12px, 2vw, 14px);
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        padding: clamp(12px, 2vw, 20px) 0;
        margin-top: clamp(12px, 2vw, 20px);
        border-top: 1px solid #e0e0e0;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header h2 {
            width: 100%;
        }

        .action-buttons {
            width: 100%;
        }

        .action-buttons .btn {
            flex: 1;
            justify-content: center;
            min-width: calc(50% - 6px);
        }

        .filter-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .filter-group {
            width: 100%;
        }

        .filter-row > div:last-child {
            grid-column: 1 / -1;
        }

        .filter-row > div:last-child .btn {
            width: 100%;
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
        }

        .table tbody td {
            padding: clamp(8px, 2vw, 12px) 0;
            border: none;
            text-align: left;
            position: relative;
            padding-left: 50%;
        }

        .table tbody td:first-child {
            font-weight: 700;
            background: #f8f9fa;
            padding-left: clamp(8px, 2vw, 12px);
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

        .table tbody td:nth-child(7) {
            grid-column: 1 / -1;
            padding: 10px 0;
        }

        .table tbody td:nth-child(7) form {
            width: 100%;
        }

        .table tbody td:nth-child(7) .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .filter-body {
            padding: 12px;
        }

        .form-control,
        .form-select {
            padding: 8px 10px;
            font-size: 14px;
        }

        .btn {
            padding: 8px 10px;
            font-size: 12px;
        }

        .action-buttons {
            gap: 6px;
        }

        .action-buttons .btn {
            min-width: calc(50% - 3px);
        }

        .data-card .card-body {
            padding: 12px;
        }

        .table tbody td {
            padding: 8px 0;
            padding-left: 45%;
        }
    }

    @media (max-width: 360px) {
        .page-header h2 {
            font-size: 20px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            min-width: 100%;
            width: 100%;
        }

        .filter-header h5 {
            font-size: 14px;
        }

        .form-label {
            font-size: 12px;
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

    .filter-card,
    .data-card {
        animation: fadeInUp 0.5s ease;
    }

    .filter-card {
        animation-delay: 0.1s;
    }

    .data-card {
        animation-delay: 0.2s;
    }
</style>

<div class="page-header">
    <h2><i class="bi bi-clipboard-check"></i> Data Absensi</h2>
    <div class="action-buttons">
        <a href="{{ route('absensi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Input Absensi
        </a>
        <div class="btn-group" role="group" style="display: flex;">
            <button type="button" class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-download"></i> Export
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('export.pdf', request()->query()) }}">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('export.excel', request()->query()) }}">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Excel
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="filter-card">
    <div class="filter-header">
        <h5><i class="bi bi-funnel"></i> Filter Data</h5>
    </div>
    <div class="filter-body">
        <form method="GET" action="{{ route('absensi.index') }}" class="filter-row">
            <div class="filter-group">
                <label for="kelas_id" class="form-label">Kelas</label>
                <select class="form-control" id="kelas_id" name="kelas_id">
                    <option value="">-- Semua Kelas --</option>
                    @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
            </div>

            <div class="filter-group">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
            </div>

            <div class="filter-group">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="">-- Semua Status --</option>
                    <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Sakit" {{ request('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                    <option value="Alpa" {{ request('status') == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                </select>
            </div>

            <div class="filter-group" style="grid-column: 1 / -1;">
                <div style="display: flex; gap: clamp(8px, 2vw, 12px);">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">
                        <i class="bi bi-search"></i> Filter
                    </button>
                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary" style="flex: 1; text-decoration: none; justify-content: center;">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="data-card">
    <div class="card-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $key => $item)
                    <tr>
                        <td data-label="No">{{ ($absensi->currentPage() - 1) * $absensi->perPage() + $key + 1 }}</td>
                        <td data-label="Nama Siswa">{{ $item->siswa->nama_lengkap }}</td>
                        <td data-label="Kelas"><span class="badge badge-info">{{ $item->kelas->nama_kelas }}</span></td>
                        <td data-label="Tanggal">{{ $item->tanggal_absen->format('d-m-Y') }}</td>
                        <td data-label="Status">
                            @if($item->status === 'Hadir')
                                <span class="badge badge-hadir"><i class="bi bi-check-circle"></i> {{ $item->status }}</span>
                            @elseif($item->status === 'Sakit')
                                <span class="badge badge-sakit"><i class="bi bi-exclamation-circle"></i> {{ $item->status }}</span>
                            @elseif($item->status === 'Izin')
                                <span class="badge badge-izin"><i class="bi bi-hand-thumbs-up"></i> {{ $item->status }}</span>
                            @else
                                <span class="badge badge-alpa"><i class="bi bi-x-circle"></i> {{ $item->status }}</span>
                            @endif
                        </td>
                        <td data-label="Keterangan">{{ $item->keterangan ?? '-' }}</td>
                        <td data-label="Aksi">
                            <form action="{{ route('absensi.destroy', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data absensi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $absensi->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
