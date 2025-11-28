@extends('layouts.app')

@section('title', 'Input Absensi')

@section('content')
<style>
    /* Page Header */
    .page-header {
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
    }

    .page-header i {
        font-size: clamp(24px, 6vw, 32px);
        color: #667eea;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .form-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .form-card .card-body {
        padding: clamp(20px, 5vw, 30px);
    }

    /* Form Controls */
    .form-group {
        margin-bottom: clamp(16px, 3vw, 20px);
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: clamp(13px, 2.5vw, 15px);
    }

    .form-label i {
        margin-right: 6px;
        color: #667eea;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: clamp(10px, 2vw, 12px) 14px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
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

    /* Form Row */
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: clamp(12px, 3vw, 20px);
    }

    .form-row .form-group {
        margin-bottom: 0;
    }

    /* Section Title */
    .section-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: clamp(12px, 3vw, 20px);
        margin-bottom: clamp(15px, 3vw, 25px);
        padding-bottom: clamp(12px, 2vw, 15px);
        border-bottom: 2px solid #e0e0e0;
    }

    .section-header h5 {
        font-size: clamp(16px, 3vw, 18px);
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: clamp(6px, 1.5vw, 10px);
    }

    .btn-quick-status {
        padding: clamp(6px, 1.5vw, 8px) clamp(10px, 2vw, 14px);
        font-weight: 600;
        border-radius: 6px;
        border: 2px solid;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: clamp(12px, 2vw, 13px);
        white-space: nowrap;
    }

    .btn-quick-status-success {
        border-color: #28a745;
        color: #28a745;
    }

    .btn-quick-status-success:hover {
        background: #28a745;
        color: white;
    }

    .btn-quick-status-warning {
        border-color: #ffc107;
        color: #ffc107;
    }

    .btn-quick-status-warning:hover {
        background: #ffc107;
        color: white;
    }

    .btn-quick-status-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-quick-status-info:hover {
        background: #17a2b8;
        color: white;
    }

    .btn-quick-status-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-quick-status-danger:hover {
        background: #dc3545;
        color: white;
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

    .status-select {
        width: 100%;
        padding: clamp(6px, 1.5vw, 8px) 10px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 13px;
    }

    .keterangan-input {
        width: 100%;
        padding: clamp(6px, 1.5vw, 8px) 10px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 13px;
    }

    /* Button Group */
    .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: clamp(10px, 2vw, 15px);
        margin-top: clamp(25px, 5vw, 35px);
    }

    /* Button Styles */
    .btn {
        padding: clamp(10px, 2vw, 12px) clamp(16px, 4vw, 24px);
        font-weight: 600;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: clamp(14px, 2vw, 16px);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 44px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
        min-width: 140px;
        justify-content: center;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    .btn-secondary {
        background: #e9ecef;
        color: #666;
        flex: 1;
        min-width: 140px;
        justify-content: center;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: #dee2e6;
        color: #333;
    }

    .btn i {
        font-size: clamp(14px, 2.5vw, 16px);
    }

    /* Container */
    .form-container {
        max-width: 1000px;
        margin: 0 auto;
        width: 100%;
        padding: 0 clamp(12px, 3vw, 20px);
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .form-card .card-body {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .action-buttons {
            width: 100%;
            gap: 8px;
        }

        .btn-quick-status {
            flex: 1;
            justify-content: center;
            min-width: calc(50% - 4px);
        }

        .button-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

        .table-wrapper {
            margin: 0 -20px;
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
    }

    @media (max-width: 480px) {
        .form-card .card-body {
            padding: 16px;
        }

        .form-label {
            font-size: 13px;
        }

        .form-control,
        .form-select {
            padding: 10px 12px;
        }

        .btn-quick-status {
            padding: 6px 8px;
            font-size: 12px;
            min-width: calc(50% - 4px);
        }

        .status-select,
        .keterangan-input {
            padding: 6px 8px;
            font-size: 12px;
        }

        .button-group {
            gap: 10px;
        }

        .btn {
            padding: 10px 12px;
            font-size: 13px;
            min-height: 40px;
        }
    }

    @media (max-width: 360px) {
        .page-header h2 {
            font-size: 20px;
        }

        .form-card .card-body {
            padding: 14px;
        }

        .form-control,
        .form-select {
            padding: 9px 10px;
        }

        .btn-quick-status {
            min-width: 100%;
            margin-bottom: 6px;
        }

        .action-buttons {
            flex-direction: column;
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

    .form-card {
        animation: fadeInUp 0.5s ease;
    }
</style>

<div class="form-container">
    <div class="page-header">
        <h2><i class="bi bi-clipboard-check"></i> Input Absensi</h2>
    </div>

    <div class="form-card card">
        <div class="card-body">
            <form action="{{ route('absensi.store') }}" method="POST" id="absensiForm" novalidate>
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="kelas_id" class="form-label">
                            <i class="bi bi-door-closed"></i> Kelas
                        </label>
                        <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required onchange="loadSiswa()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_absen" class="form-label">
                            <i class="bi bi-calendar"></i> Tanggal Absensi
                        </label>
                        <input type="date" class="form-control @error('tanggal_absen') is-invalid @enderror" id="tanggal_absen" name="tanggal_absen" value="{{ old('tanggal_absen', date('Y-m-d')) }}" required>
                        @error('tanggal_absen')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div id="siswas-container">
                    <div class="section-header">
                        <h5><i class="bi bi-people-fill"></i> Daftar Siswa</h5>
                        <div class="action-buttons">
                            <button type="button" class="btn-quick-status btn-quick-status-success" onclick="setAllStatus('Hadir')">
                                <i class="bi bi-check-circle"></i> Semua Hadir
                            </button>
                            <button type="button" class="btn-quick-status btn-quick-status-warning" onclick="setAllStatus('Sakit')">
                                <i class="bi bi-exclamation-circle"></i> Semua Sakit
                            </button>
                            <button type="button" class="btn-quick-status btn-quick-status-info" onclick="setAllStatus('Izin')">
                                <i class="bi bi-hand-thumbs-up"></i> Semua Izin
                            </button>
                            <button type="button" class="btn-quick-status btn-quick-status-danger" onclick="setAllStatus('Alpa')">
                                <i class="bi bi-x-circle"></i> Semua Alpa
                            </button>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="siswas-list">
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Pilih kelas terlebih dahulu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Simpan Absensi
                    </button>
                    <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function loadSiswa() {
    const kelasId = document.getElementById('kelas_id').value;
    
    if (!kelasId) {
        document.getElementById('siswas-list').innerHTML = 
            '<tr><td colspan="5" class="text-center text-muted">Pilih kelas terlebih dahulu</td></tr>';
        return;
    }

    fetch(`/absensi/get-siswa/${kelasId}`)
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach((siswa, index) => {
                html += `
                    <tr>
                        <td data-label="No">${index + 1}</td>
                        <td data-label="NIS"><strong>${siswa.nis}</strong></td>
                        <td data-label="Nama Siswa">${siswa.nama_lengkap}</td>
                        <td data-label="Status">
                            <select name="absensi[${siswa.id}][status]" class="status-select" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                            <input type="hidden" name="absensi[${siswa.id}][siswa_id]" value="${siswa.id}">
                        </td>
                        <td data-label="Keterangan">
                            <input type="text" name="absensi[${siswa.id}][keterangan]" class="keterangan-input" placeholder="Opsional">
                        </td>
                    </tr>
                `;
            });
            document.getElementById('siswas-list').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
}

function setAllStatus(status) {
    document.querySelectorAll('.status-select').forEach(select => {
        select.value = status;
    });
}

// Load siswa jika kelas sudah dipilih saat page load
window.addEventListener('load', () => {
    const kelasId = document.getElementById('kelas_id').value;
    if (kelasId) {
        loadSiswa();
    }
});
</script>
@endsection
