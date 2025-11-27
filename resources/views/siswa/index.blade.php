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
                        <td>{{ ($siswas->currentPage() - 1) * $siswas->perPage() + $key + 1 }}</td>
                        <td><strong>{{ $siswa->nis }}</strong></td>
                        <td>{{ $siswa->nama_lengkap }}</td>
                        <td>{{ $siswa->jenis_kelamin }}</td>
                        <td><span class="badge bg-info">{{ $siswa->kelas->nama_kelas ?? '-' }}</span></td>
                        <td>{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                        <td>{{ $siswa->no_telp ?? '-' }}</td>
                        <td>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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

        <div class="d-flex justify-content-center">
            {{ $siswas->links() }}
        </div>
    </div>
</div>
@endsection
