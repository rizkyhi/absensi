@extends('layouts.app')

@section('title', 'Input Absensi')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-clipboard-check"></i> Input Absensi</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('absensi.store') }}" method="POST" id="absensiForm">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required onchange="loadSiswa()">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal_absen" class="form-label">Tanggal Absensi</label>
                            <input type="date" class="form-control @error('tanggal_absen') is-invalid @enderror" id="tanggal_absen" name="tanggal_absen" value="{{ old('tanggal_absen', date('Y-m-d')) }}" required>
                            @error('tanggal_absen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="siswas-container" class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Daftar Siswa</h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="setAllStatus('Hadir')">Semua Hadir</button>
                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="setAllStatus('Sakit')">Semua Sakit</button>
                                <button type="button" class="btn btn-sm btn-outline-info" onclick="setAllStatus('Izin')">Semua Izin</button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="setAllStatus('Alpa')">Semua Alpa</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
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

                    <div class="d-flex gap-2">
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
                        <td>${index + 1}</td>
                        <td><strong>${siswa.nis}</strong></td>
                        <td>${siswa.nama_lengkap}</td>
                        <td>
                            <select name="absensi[${siswa.id}][status]" class="form-control form-control-sm status-select" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                            <input type="hidden" name="absensi[${siswa.id}][siswa_id]" value="${siswa.id}">
                        </td>
                        <td>
                            <input type="text" name="absensi[${siswa.id}][keterangan]" class="form-control form-control-sm" placeholder="Opsional">
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
