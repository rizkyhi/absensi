@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-people-fill"></i> Data Siswa</h2>
    </div>
    <div class="col-md-4 text-end">
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('siswa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Siswa
        </a>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
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

    .badge-kelas {
        background-color: #667eea;
        color: white;
    }

    /* Button Styles */
    .btn {
        padding: clamp(6px, 1.2vw, 8px) clamp(8px, 1.5vw, 12px);
        font-weight: 600;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: clamp(11px, 1.6vw, 12px);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        min-height: 34px;
        white-space: nowrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-edit {
        background: #ffc107;
        color: #333;
    }

    .btn-edit:hover {
        background: #ffb300;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .btn i {
        font-size: clamp(10px, 1.8vw, 12px);
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

        .table tbody td:nth-child(8) {
            grid-column: 1 / -1;
            padding: 10px 0;
        }

        .table tbody td:nth-child(8) {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .table tbody td:nth-child(8) form {
            width: 100%;
        }

        .table tbody td:nth-child(8) .btn,
        .table tbody td:nth-child(8) a.btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .data-card .card-body {
            padding: 12px;
        }

        .table tbody td {
            padding: 8px 0;
            padding-left: 45%;
        }

        .btn {
            padding: 6px 8px;
            min-height: 32px;
        }
    }

    @media (max-width: 360px) {
        .page-header h2 {
            font-size: 20px;
        }

        .data-card .card-body {
            padding: 12px;
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

    .page-header {
        animation: fadeInUp 0.5s ease;
    }

    .data-card {
        animation: fadeInUp 0.5s ease 0.1s both;
    }
</style>

<div class="page-header">
    <h2><i class="bi bi-people-fill"></i> Data Siswa</h2>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('siswa.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Siswa
    </a>
    @endif
</div>

<div class="data-card">
    <div class="card-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Tanggal Lahir</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $key => $siswa)
                    <tr>
                        <td data-label="No">{{ ($siswas->currentPage() - 1) * $siswas->perPage() + $key + 1 }}</td>
                        <td data-label="NIS"><strong>{{ $siswa->nis }}</strong></td>
                        <td data-label="Nama Lengkap">{{ $siswa->nama_lengkap }}</td>
                        <td data-label="Jenis Kelamin">{{ $siswa->jenis_kelamin }}</td>
                        <td data-label="Kelas"><span class="badge badge-kelas">{{ $siswa->kelas->nama_kelas ?? '-' }}</span></td>
                        <td data-label="Tanggal Lahir">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                        <td data-label="No. Telepon">{{ $siswa->no_telp ?? '-' }}</td>
                        <td data-label="Aksi">
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-edit">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $siswas->links() }}
        </div>
    </div>
</div>
@endsection
