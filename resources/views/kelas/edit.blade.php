@extends('layouts.app')

@section('title', 'Edit Kelas')

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

    .form-control,
    .form-select {
        width: 100%;
        padding: clamp(10px, 2vw, 12px) 14px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        font-family: inherit;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: #667eea;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-control:disabled,
    .form-select:disabled {
        background-color: #f5f5f5;
        color: #888;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    /* Error Messages */
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: clamp(12px, 2vw, 13px);
        margin-top: 6px;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Form Row */
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: clamp(12px, 3vw, 20px);
    }

    /* Buttons Container */
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
        min-height: 48px; /* larger touch target */
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        flex: none;
        min-width: 140px;
        justify-content: center;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-secondary {
        background: #e9ecef;
        color: #666;
        flex: none;
        min-width: 140px;
        justify-content: center;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: #dee2e6;
        color: #333;
        text-decoration: none;
    }

    .btn i {
        font-size: clamp(14px, 2.5vw, 16px);
    }

    /* Container */
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        width: 100%;
        padding: 0 clamp(12px, 3vw, 20px);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .form-card .card-body {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .button-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .page-header h2 {
            font-size: 20px;
            gap: 8px;
        }

        .page-header i {
            font-size: 20px;
        }

        .form-card .card-body {
            padding: 16px;
        }

        .form-label {
            font-size: 13px;
        }

        .form-control,
        .form-select {
            padding: 10px 12px;
            font-size: 16px;
        }

        .button-group {
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            width: 100%;
            padding: 11px 14px;
        }
    }

    @media (max-width: 360px) {
        .page-header h2 {
            font-size: 18px;
        }

        .form-card .card-body {
            padding: 14px;
        }

        .form-control,
        .form-select {
            padding: 9px 10px;
        }
    }
</style>

<div class="form-container">
    <div class="page-header">
        <h2><i class="bi bi-door-closed"></i> Edit Data Kelas</h2>
    </div>

    <div class="form-card card">
        <div class="card-body">
            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_kelas" class="form-label">
                        <i class="bi bi-input-cursor"></i> Nama Kelas
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('nama_kelas') is-invalid @enderror" 
                        id="nama_kelas" 
                        name="nama_kelas" 
                        value="{{ old('nama_kelas', $kelas->nama_kelas) }}" 
                        required
                        autocomplete="off"
                    >
                    @error('nama_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tingkat" class="form-label">
                            <i class="bi bi-ladder"></i> Tingkat
                        </label>
                        <select class="form-control @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" required>
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="X" {{ old('tingkat', $kelas->tingkat) == 'X' ? 'selected' : '' }}>X</option>
                            <option value="XI" {{ old('tingkat', $kelas->tingkat) == 'XI' ? 'selected' : '' }}>XI</option>
                            <option value="XII" {{ old('tingkat', $kelas->tingkat) == 'XII' ? 'selected' : '' }}>XII</option>
                        </select>
                        @error('tingkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jurusan" class="form-label">
                            <i class="bi bi-briefcase"></i> Jurusan
                        </label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="jurusan" 
                            name="jurusan" 
                            value="{{ old('jurusan', $kelas->jurusan) }}"
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="kapasitas" class="form-label">
                        <i class="bi bi-people"></i> Kapasitas Siswa
                    </label>
                    <input 
                        type="number" 
                        inputmode="numeric" pattern="\d*" step="1"
                        class="form-control @error('kapasitas') is-invalid @enderror" 
                        id="kapasitas" 
                        name="kapasitas" 
                        min="1" 
                        max="100" 
                        value="{{ old('kapasitas', $kelas->kapasitas) }}" 
                        required
                    >
                    @error('kapasitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
