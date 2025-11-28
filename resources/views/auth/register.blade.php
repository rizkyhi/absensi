<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aplikasi Absensi Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: clamp(12px, 3vw, 20px);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .register-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: clamp(25px, 5vw, 40px);
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .register-header {
            text-align: center;
            margin-bottom: clamp(25px, 5vw, 35px);
            padding-bottom: clamp(15px, 3vw, 20px);
            border-bottom: 2px solid #f0f0f0;
        }

        .register-header h1 {
            font-size: clamp(24px, 6vw, 32px);
            color: #667eea;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .register-header h1 i {
            font-size: clamp(24px, 6vw, 32px);
        }

        .register-header p {
            color: #888;
            font-size: clamp(13px, 2.5vw, 15px);
            margin: 0;
        }

        /* Form Group */
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
            font-family: inherit;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control::placeholder {
            color: #999;
        }

        /* Form Row */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: clamp(12px, 2vw, 15px);
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        /* Alert */
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: clamp(15px, 3vw, 20px);
            padding: clamp(12px, 2vw, 15px) clamp(15px, 3vw, 20px);
            font-size: clamp(13px, 2vw, 14px);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .alert li {
            margin-bottom: 4px;
            font-size: clamp(12px, 1.8vw, 13px);
        }

        /* Button */
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: clamp(11px, 2vw, 13px) clamp(20px, 4vw, 24px);
            font-weight: 600;
            font-size: clamp(14px, 2vw, 16px);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register i {
            font-size: clamp(14px, 2.5vw, 16px);
        }

        /* Footer */
        .register-footer {
            text-align: center;
            margin-top: clamp(20px, 4vw, 30px);
            padding-top: clamp(15px, 3vw, 20px);
            border-top: 1px solid #e0e0e0;
        }

        .register-footer p {
            font-size: clamp(13px, 2vw, 14px);
            color: #666;
            margin: 0;
        }

        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Info Box */
        .info-box {
            background: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: clamp(12px, 2vw, 15px);
            border-radius: 6px;
            font-size: clamp(12px, 2vw, 13px);
            color: #555;
            margin-bottom: clamp(15px, 3vw, 20px);
        }

        .info-box i {
            color: #667eea;
            margin-right: 6px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 480px) {
            .register-container {
                padding: 20px;
                border-radius: 12px;
            }

            .register-header {
                margin-bottom: 20px;
            }

            .register-header h1 {
                font-size: 20px;
            }

            .register-header p {
                font-size: 12px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-control,
            .form-select {
                padding: 10px 12px;
                font-size: 16px;
                border-radius: 6px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .btn-register {
                padding: 10px 16px;
            }

            .alert {
                padding: 12px 15px;
            }

            .alert ul {
                padding-left: 18px;
            }
        }

        @media (max-width: 360px) {
            .register-container {
                padding: 16px;
                margin: 10px;
            }

            .register-header h1 {
                font-size: 18px;
                gap: 6px;
            }

            .register-header h1 i {
                font-size: 18px;
            }

            .form-control,
            .form-select {
                padding: 9px 10px;
                font-size: 16px;
            }

            .btn-register {
                min-height: 40px;
                padding: 8px 12px;
                font-size: 14px;
            }
        }

        /* Tablet Responsiveness */
        @media (max-width: 768px) {
            .register-container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>
                <i class="bi bi-person-plus-fill"></i>
                Daftar Akun Guru
            </h1>
            <p>Buat akun baru untuk mengakses sistem absensi</p>
        </div>

        <div class="info-box">
            <i class="bi bi-info-circle"></i>
            Lengkapi semua data dengan benar dan akurat
        </div>

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-circle"></i> Terjadi Kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="bi bi-person"></i> Nama Lengkap
                </label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="Masukkan nama lengkap Anda"
                    required
                    autocomplete="name"
                >
                @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope"></i> Email
                </label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="nama@example.com"
                    required
                    autocomplete="email"
                >
                @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nip" class="form-label">
                    <i class="bi bi-card-text"></i> NIP (Nomor Identitas Pegawai)
                </label>
                <input 
                    type="text" 
                    class="form-control @error('nip') is-invalid @enderror" 
                    id="nip" 
                    name="nip" 
                    value="{{ old('nip') }}" 
                    placeholder="Contoh: 123456789"
                    required
                    autocomplete="off"
                >
                @error('nip')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i> Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="Min. 8 karakter"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="bi bi-lock-check"></i> Konfirmasi Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Ulangi password"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="no_telp" class="form-label">
                    <i class="bi bi-telephone"></i> No. Telepon
                </label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="no_telp" 
                    name="no_telp" 
                    value="{{ old('no_telp') }}" 
                    placeholder="Contoh: 081234567890"
                    autocomplete="tel"
                >
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">
                    <i class="bi bi-geo-alt"></i> Alamat
                </label>
                <textarea 
                    class="form-control" 
                    id="alamat" 
                    name="alamat" 
                    rows="3" 
                    placeholder="Masukkan alamat lengkap Anda"
                    autocomplete="street-address"
                >{{ old('alamat') }}</textarea>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-person-check"></i> Daftar Sekarang
            </button>
        </form>

        <div class="register-footer">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
