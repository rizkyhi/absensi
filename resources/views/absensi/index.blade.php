@extends('layouts.app')

@section('title', 'Data Absensi')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-clipboard-check"></i> Data Absensi</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('absensi.create') }}" class="btn btn-primary me-2">
            <i class="bi bi-plus-circle"></i> Input Absensi
        </a>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="dropdown" aria-expanded="false">
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
<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Filter Data</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('absensi.index') }}" class="row g-3">
            <div class="col-md-3">
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

            <div class="col-md-2">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
            </div>

            <div class="col-md-2">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
            </div>

            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="">-- Semua Status --</option>
                    <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Sakit" {{ request('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="Izin" {{ request('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                    <option value="Alpa" {{ request('status') == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
                <a href="{{ route('absensi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Data Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
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
                        <td>{{ ($absensi->currentPage() - 1) * $absensi->perPage() + $key + 1 }}</td>
                        <td>{{ $item->siswa->nama_lengkap }}</td>
                        <td><span class="badge bg-info">{{ $item->kelas->nama_kelas }}</span></td>
                        <td>{{ $item->tanggal_absen->format('d-m-Y') }}</td>
                        <td>
                            @if($item->status === 'Hadir')
                                <span class="badge badge-hadir">{{ $item->status }}</span>
                            @elseif($item->status === 'Sakit')
                                <span class="badge badge-sakit">{{ $item->status }}</span>
                            @elseif($item->status === 'Izin')
                                <span class="badge badge-izin">{{ $item->status }}</span>
                            @else
                                <span class="badge badge-alpa">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>
                            <form action="{{ route('absensi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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

        <div class="d-flex justify-content-center">
            {{ $absensi->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
