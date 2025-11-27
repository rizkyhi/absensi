@extends('layouts.app')

@section('title', 'Detail Kelas')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-door-closed"></i> Detail Kelas: {{ $kelas->nama_kelas }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Kelas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama Kelas:</strong> {{ $kelas->nama_kelas }}</p>
                        <p><strong>Tingkat:</strong> {{ $kelas->tingkat }}</p>
                        <p><strong>Jurusan:</strong> {{ $kelas->jurusan ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Guru Pengampu:</strong> {{ $kelas->guru->nama_lengkap ?? '-' }}</p>
                        <p><strong>Kapasitas:</strong> {{ $kelas->kapasitas }} siswa</p>
                        <p><strong>Jumlah Siswa:</strong> <span class="badge bg-info">{{ $kelas->siswas->count() }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Daftar Siswa</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
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
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $siswa->nis }}</strong></td>
                                <td>{{ $siswa->nama_lengkap }}</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                                <td>{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                                <td>{{ $siswa->alamat ?? '-' }}</td>
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
    </div>
</div>
@endsection
