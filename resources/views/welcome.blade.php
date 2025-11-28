<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root{
            --primary: #7f93eb;
            --primary-dark: #c094ec;
            --muted: #96a4b1;
        }

        html,body{height:100%;}
        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            margin:0;
            color:#222;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }

        .hero {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: clamp(20px, 4vw, 40px);
            align-items: center;
            max-width: 1200px;
            margin: 40px auto;
            padding: clamp(20px, 4vw, 40px);
        }

        .hero-left {
            color: white;
            padding: clamp(20px, 4vw, 30px);
        }

        .eyebrow {
            background: rgba(255,255,255,0.08);
            display:inline-block;
            padding:6px 12px;
            border-radius:999px;
            font-weight:600;
            margin-bottom:12px;
            font-size:clamp(12px,2.2vw,13px);
        }

        h1.hero-title{
            font-size: clamp(28px, 6vw, 44px);
            line-height:1.02;
            margin:0 0 12px 0;
            font-weight:800;
            text-shadow: 0 4px 18px rgba(0,0,0,0.25);
        }

        p.lead{
            font-size: clamp(14px, 2.5vw, 18px);
            color: rgba(255,255,255,0.92);
            margin-bottom:18px;
        }

        .hero-ctas { display:flex; gap:12px; flex-wrap:wrap; }
        .btn-cta {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight:700;
            min-height:44px;
        }

        .btn-primary-hero{
            background: linear-gradient(135deg,var(--primary),var(--primary-dark));
            border:none;
            color:white;
        }

        .btn-outline-hero{
            background: rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.12);
            color:white;
        }

        .hero-right{
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .panel-card{
            background:white;
            border-radius:14px;
            padding:18px;
            width:100%;
            box-shadow:0 12px 40px rgba(0,0,0,0.18);
        }

        .panel-icon{font-size:44px;color:var(--primary);}
        .panel-title{font-weight:700;margin-top:8px;margin-bottom:6px}
        .panel-desc{color:var(--muted);font-size:14px}

        .features-grid{
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
            gap:16px;
            margin-top:22px;
        }

        .feature-card{
            display:flex;align-items:flex-start;gap:12px;padding:12px;border-radius:10px;background:#fff;
            box-shadow:0 6px 18px rgba(0,0,0,0.06);
        }

        .feature-card .icon{font-size:20px;color:var(--primary);margin-top:4px}
        .feature-card .text{font-weight:600}

        footer{max-width:1200px;margin:24px auto;color:rgba(255,255,255,0.85);text-align:center;padding:12px}

        @media (max-width: 920px){
            .hero{grid-template-columns:1fr; padding:20px; margin:20px;}
            .hero-right{order:-1}
        }

        @media (max-width:480px){
            .panel-card{padding:14px}
            .hero-title{font-size:28px}
        }

        /* subtle animation */
        .fade-up{animation:fadeUp .6s ease both}
        @keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-left fade-up">
            <div class="eyebrow">Sistem Absensi</div>
            <h1 class="hero-title">AbsenKelas — Kelola Kehadiran dengan Cepat & Rapi</h1>
            <p class="lead">Aplikasi sederhana untuk manajemen absensi siswa, laporan export, dan analitik cepat untuk guru serta admin sekolah.</p>

            <div class="hero-ctas">
                <a href="{{ route('login') }}" class="btn btn-cta btn-primary-hero">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-cta btn-outline-hero">
                    <i class="bi bi-person-plus"></i> Daftar
                </a>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="icon"><i class="bi bi-speedometer2"></i></div>
                    <div class="text">Dashboard analitik & ringkasan performa</div>
                </div>
                <div class="feature-card">
                    <div class="icon"><i class="bi bi-people-fill"></i></div>
                    <div class="text">Manajemen data siswa & kelas</div>
                </div>
                <div class="feature-card">
                    <div class="icon"><i class="bi bi-clipboard-check"></i></div>
                    <div class="text">Input absensi cepat dengan status lengkap</div>
                </div>
                <div class="feature-card">
                    <div class="icon"><i class="bi bi-file-earmark-spreadsheet"></i></div>
                    <div class="text">Export laporan PDF / Excel</div>
                </div>
            </div>
        </div>

        <div class="hero-right fade-up">
            <div class="panel-card">
                <div style="display:flex;align-items:center;gap:12px">
                    <div class="panel-icon"><i class="bi bi-calendar-check"></i></div>
                    <div>
                        <div class="panel-title">Mulai Sekarang</div>
                        <div class="panel-desc">Coba demo atau daftar akun baru untuk mengelola absensi.</div>
                    </div>
                </div>

                <div style="margin-top:15px">
                    <div style="font-weight:700;margin-bottom:6px">Akun Demo</div>
                    <div style="color:var(--muted);font-size:14px">Admin: admin@test.com / admin123</div>
                    <div style="color:var(--muted);font-size:14px">Guru: guru1@test.com / guru123</div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Absen Kelas • Dibuat untuk manajemen kehadiran sederhana
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
