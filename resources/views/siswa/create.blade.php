@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2><i class="bi bi-person-plus-fill"></i> Tambah Siswa Baru</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
<style>
    /* Page Header */
    .page-header {
        display: flex;
        align-items: center;
        gap: clamp(12px, 3vw, 20px);
        margin-bottom: clamp(25px, 5vw, 35px);
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .page-header h2 {
                    
                </div>

                {{-- Optional fields hidden by default to keep form compact --}}
                @php
                    $openOptional = $errors->has('tanggal_lahir') || $errors->has('alamat') || $errors->has('no_telp') || $errors->has('nama_orang_tua') || old('tanggal_lahir') || old('alamat') || old('no_telp') || old('nama_orang_tua');
                @endphp

                <details class="mt-3" {{ $openOptional ? 'open' : '' }}>
                    <summary style="cursor:pointer; font-weight:600; color:#333;">Tambahkan info tambahan (opsional)</summary>
                    <div style="margin-top:12px;">
                        <div class="form-group">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="no_telp" class="form-label">No. Telepon</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_orang_tua" class="form-label">Nama Orang Tua/Wali</label>
                                <input type="text" class="form-control @error('nama_orang_tua') is-invalid @enderror" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua') }}">
                                @error('nama_orang_tua')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </details>
        margin-bottom: 8px;
        font-size: clamp(13px, 2.5vw, 14px);
        display: block;
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

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    /* Form Row */
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: clamp(12px, 2vw, 15px);
    }

    /* Button Styles */
    .button-group {
        display: flex;
        gap: clamp(8px, 2vw, 12px);
        margin-top: clamp(20px, 4vw, 30px);
        flex-wrap: wrap;
    }

    .btn {
        padding: clamp(10px, 1.8vw, 12px) clamp(16px, 3vw, 24px);
        font-weight: 600;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: clamp(12px, 1.8vw, 13px);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 44px;
        white-space: nowrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: 1;
        justify-content: center;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #e9ecef;
        color: #666;
        flex: 1;
        justify-content: center;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: #dee2e6;
    }

    .btn i {
        font-size: clamp(12px, 2vw, 14px);
    }

    /* Animation */
    @keyframes slideUp {
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
        animation: slideUp 0.5s ease;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .form-control,
        .form-select {
            padding: 8px 10px;
            font-size: 14px;
        }

        .button-group {
            flex-direction: column;
            gap: 10px;
        }

        .button-group .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .form-card .card-body {
            padding: 15px;
        }

        .form-label {
            font-size: 12px;
        }

        .form-control,
        .form-select {
            padding: 8px 10px;
            font-size: 13px;
        }

        .button-group .btn {
            min-height: 40px;
        }
    }

    @media (max-width: 360px) {
        .page-header h2 {
            font-size: 18px;
        }

        .form-card .card-body {
            padding: 12px;
        }
    }
</style>

<div class="page-header">
    <h2><i class="bi bi-person-plus-fill"></i> Tambah Siswa Baru</h2>
</div>

<div class="form-container">
    <div class="form-card">
        <div class="card-body">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="kelas_id" class="form-label">Kelas <span style="color: #dc3545;">*</span></label>
                        <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }} ({{ $k->tingkat }} {{ $k->jurusan ?? '' }})
                            </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group">
                    <label for="nis" class="form-label">NIS (Nomor Induk Siswa) <span style="color: #dc3545;">*</span></label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}" required>
                        @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-group">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span style="color: #dc3545;">*</span></label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                        @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span style="color: #dc3545;">*</span></label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                    </div>

                <div class="form-group">
                    <label for="nama_orang_tua" class="form-label">Nama Orang Tua/Wali</label>
                        <input type="text" class="form-control" id="nama_orang_tua" name="nama_orang_tua" value="{{ old('nama_orang_tua') }}">
                    </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Simpan
                    </button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
@endsection