@extends('layouts.app')

@section('title', 'Daftar Kelas')

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

        /* Card */
        .data-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: none;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .data-card .card-body {
            padding: clamp(15px, 4vw, 25px);
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

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-warning:hover {
            background: #e0a800;
            color: #333;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            color: white;
        }

        .btn i {
            font-size: clamp(12px, 2vw, 14px);
        }

        /* Table Responsive */
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .table thead th {
            color: white;
            padding: clamp(10px, 2vw, 15px);
            font-weight: 600;
            font-size: clamp(12px, 2vw, 14px);
            border: none;
            text-align: left;
        }

        .table tbody td {
            padding: clamp(10px, 2vw, 15px);
            border-bottom: 1px solid #e0e0e0;
            font-size: clamp(12px, 2vw, 14px);
            vertical-align: middle;
            overflow-wrap: anywhere;
            /* prevent overflow on long text */
            word-break: break-word;
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

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: clamp(15px, 3vw, 25px) 0;
            margin-top: clamp(15px, 3vw, 25px);
            border-top: 1px solid #e0e0e0;
        }

        /* Actions Column */
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: clamp(4px, 1.5vw, 8px);
            align-items: center;
        }

        .action-form {
            display: inline;
            margin: 0;
        }

        /* Mobile Card View */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header h2 {
                width: 100%;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
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
                margin-bottom: clamp(15px, 3vw, 20px);
            }

            .table tbody tr {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: clamp(12px, 2vw, 15px);
                margin-bottom: clamp(12px, 2vw, 20px);
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

            .action-buttons {
                flex-direction: column;
                gap: 8px;
                margin-top: 10px;
            }

            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }

            .action-form {
                width: 100%;
            }

            .action-form .btn {
                width: 100%;
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
                padding: 8px 10px;
                font-size: 12px;
            }

            .badge {
                padding: 4px 8px;
                font-size: 10px;
            }

            .table tbody td::before {
                font-size: 10px;
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

        .data-card {
            animation: fadeInUp 0.5s ease;
        }
    </style>

    <div class="page-header">
        <h2><i class="bi bi-door-closed"></i> Data Kelas</h2>
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('kelas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Kelas
            </a>
        @endif
    </div>

    <div class="data-card card">
        <div class="card-body">
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Tingkat</th>
                            <th>Jurusan</th>
                            <th>Jumlah Siswa</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $key => $k)
                            <tr>
                                <td data-label="No">{{ ($kelas->currentPage() - 1) * $kelas->perPage() + $key + 1 }}</td>
                                <td data-label="Nama Kelas"><strong>{{ $k->nama_kelas }}</strong></td>
                                <td data-label="Tingkat">{{ $k->tingkat }}</td>
                                <td data-label="Jurusan">{{ $k->jurusan ?? '-' }}</td>
                                <td data-label="Jumlah Siswa"><span
                                        class="badge bg-info">{{ $k->siswas_count ?? $k->siswas->count() }}</span></td>
                                <td data-label="Kapasitas">{{ $k->kapasitas }}</td>
                                <td data-label="Aksi">
                                    <div class="action-buttons">
                                        <a href="{{ route('kelas.show', $k->id) }}" class="btn btn-info">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                        @if (auth()->user()->role === 'admin')
                                            <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <button class="btn btn-danger"
                                                onclick="deleteKelas({{ $k->id }}, '{{ $k->nama_kelas }}')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data kelas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $kelas->links() }}
            </div>
        </div>
    </div>

    <script>
    function deleteKelas(id, nama) {
        console.log('Delete function called for ID:', id); // Debug
        
        if (confirm(`Apakah Anda yakin ingin menghapus kelas "${nama}"?\n\nTindakan ini akan menghapus semua data siswa dan absensi yang terkait.`)) {
            
            console.log('User confirmed deletion'); // Debug
            
            // Create form dynamically
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ url('kelas') }}/" + id;
            
            console.log('Form action:', form.action); // Debug

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = csrfToken.getAttribute('content');
                form.appendChild(tokenInput);
                console.log('CSRF token added'); // Debug
            } else {
                console.error('CSRF token not found!'); // Debug
                alert('CSRF token tidak ditemukan!');
                return;
            }

            // Add DELETE method
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            console.log('DELETE method added'); // Debug

            // Submit form
            document.body.appendChild(form);
            console.log('Form appended to body, submitting...'); // Debug
            form.submit();
        } else {
            console.log('User cancelled deletion'); // Debug
        }
    }
</script>
@endsection
