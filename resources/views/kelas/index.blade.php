@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-door-closed"></i> Data Kelas</h2>
    </div>
    <div class="col-md-4 text-end">
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('kelas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kelas
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
                        <td>{{ ($kelas->currentPage() - 1) * $kelas->perPage() + $key + 1 }}</td>
                        <td><strong>{{ $k->nama_kelas }}</strong></td>
                        <td>{{ $k->tingkat }}</td>
                        <td>{{ $k->jurusan ?? '-' }}</td>
                        <td><span class="badge bg-info">{{ $k->siswas_count ?? $k->siswas->count() }}</span></td>
                        <td>{{ $k->kapasitas }}</td>
                        <td>
                            <a href="{{ route('kelas.show', $k->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="d-inline">
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
                        <td colspan="8" class="text-center text-muted">Belum ada data kelas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $kelas->links() }}
        </div>
    </div>
</div>
@endsection
