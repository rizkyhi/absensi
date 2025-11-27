<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi Kelas - Sistem Digital Manajemen Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .welcome-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 60px 40px;
            text-align: center;
            max-width: 600px;
        }

        .welcome-icon {
            font-size: 80px;
            color: #667eea;
            margin-bottom: 20px;
        }

        .welcome-title {
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome-subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 16px;
        }

        .features {
            text-align: left;
            margin: 40px 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .feature-icon {
            color: #667eea;
            font-size: 24px;
            margin-right: 15px;
            min-width: 30px;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 40px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 30px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }

        .btn-register {
            border: 2px solid #667eea;
            color: #667eea;
            padding: 10px 30px;
            font-weight: bold;
            margin-top: 30px;
            margin-left: 10px;
        }

        .btn-register:hover {
            background: #667eea;
            color: white;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-icon">
            <i class="bi bi-calendar-check"></i>
        </div>
        <h1 class="welcome-title">Aplikasi Absensi Kelas</h1>
        <p class="welcome-subtitle">Sistem Informasi Digital Manajemen Kehadiran Siswa</p>

        <div class="features">
            <div class="feature-item">
                <i class="bi bi-speedometer2 feature-icon"></i>
                <div>Dashboard analitik dengan grafik real-time</div>
            </div>
            <div class="feature-item">
                <i class="bi bi-people-fill feature-icon"></i>
                <div>Manajemen data guru dan siswa yang lengkap</div>
            </div>
            <div class="feature-item">
                <i class="bi bi-door-closed feature-icon"></i>
                <div>Pengelolaan kelas dan absensi per kelas</div>
            </div>
            <div class="feature-item">
                <i class="bi bi-clipboard-check feature-icon"></i>
                <div>Input absensi dengan berbagai status (Hadir, Sakit, Izin, Alpa)</div>
            </div>
            <div class="feature-item">
                <i class="bi bi-calendar-range feature-icon"></i>
                <div>Filter data berdasarkan tanggal dan periode</div>
            </div>
            <div class="feature-item">
                <i class="bi bi-download feature-icon"></i>
                <div>Export laporan dalam format PDF dan Excel</div>
            </div>
        </div>

        <div>
            <a href="{{ route('login') }}" class="btn btn-login text-white">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-register">
                <i class="bi bi-person-plus"></i> Daftar
            </a>
        </div>

        <hr style="margin-top: 40px;">

        <div class="text-muted small">
            <p><strong>Akun Demo untuk Testing:</strong></p>
            <p><strong>Admin:</strong> admin@test.com / admin123</p>
            <p><strong>Guru:</strong> guru1@test.com / guru123</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
