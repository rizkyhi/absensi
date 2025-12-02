<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AbsenKelas - Sistem Manajemen Absensi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #667eea;
            --primary-dark: #764ba2;
            --primary-light: #8b9df0;
            --secondary: #f093fb;
            --success: #13c296;
            --danger: #ff6b6b;
            --warning: #ffa94d;
            --muted: #96a4b1;
            --light-bg: #f8f9fa;
            --border-color: #e0e0e0;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            margin: 0;
            color: #222;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Shapes */
        body::before {
            content: '';
            position: fixed;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            z-index: 0;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            z-index: 0;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-up {
            animation: fadeInUp 0.8s ease both;
        }

        .slide-left {
            animation: slideInLeft 0.8s ease both;
        }

        .slide-right {
            animation: slideInRight 0.8s ease both;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        /* Hero Section */
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(30px, 6vw, 60px);
            align-items: center;
            max-width: 1280px;
            margin: 60px auto;
            padding: clamp(20px, 4vw, 60px);
            position: relative;
            z-index: 1;
        }

        .hero-left {
            color: white;
            padding: clamp(20px, 4vw, 30px);
        }

        .eyebrow {
            background: rgba(255, 255, 255, 0.15);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 999px;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: clamp(12px, 2.5vw, 14px);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h1.hero-title {
            font-size: clamp(32px, 7vw, 56px);
            line-height: 1.15;
            margin: 0 0 16px 0;
            font-weight: 800;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #ffffff 0%, rgba(255, 255, 255, 0.9) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        p.lead {
            font-size: clamp(16px, 2.8vw, 20px);
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .hero-ctas {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .btn-cta {
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 700;
            min-height: 48px;
            font-size: 15px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
            border: none;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
        }

        .btn-primary-hero {
            background: linear-gradient(135deg, #ffffff 0%, rgba(255, 255, 255, 0.95) 100%);
            color: var(--primary);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-primary-hero:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .btn-outline-hero {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            backdrop-filter: blur(10px);
        }

        .btn-outline-hero:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .hero-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }

        .hero-feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
        }

        .hero-feature-item i {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
        }

        .hero-feature-item span {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
        }

        /* Demo Card Section */
        .hero-right {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
        }

        .demo-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            padding: clamp(24px, 5vw, 32px);
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .demo-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .demo-card-icon {
            font-size: 48px;
            color: var(--primary);
        }

        .demo-card-title {
            font-weight: 700;
            font-size: 20px;
            color: #222;
            margin: 0;
        }

        .demo-card-desc {
            color: var(--muted);
            font-size: 13px;
            margin: 0;
        }

        .demo-credentials {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .demo-credentials-title {
            font-weight: 700;
            color: #222;
            margin-bottom: 12px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .credential-item {
            background: white;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 8px;
            font-size: 13px;
            color: #333;
            border-left: 3px solid var(--primary);
            font-family: 'Monaco', 'Courier New', monospace;
        }

        .credential-item:last-child {
            margin-bottom: 0;
        }

        .credential-label {
            font-weight: 600;
            color: var(--primary);
            margin-right: 6px;
        }

        .demo-note {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.5;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .demo-note i {
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Features Grid */
        .features-section {
            max-width: 1280px;
            margin: 80px auto;
            padding: clamp(20px, 4vw, 60px);
            position: relative;
            z-index: 1;
        }

        .section-title {
            text-align: center;
            color: white;
            font-size: clamp(28px, 6vw, 40px);
            font-weight: 800;
            margin-bottom: 50px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 28px 24px;
            transition: all 0.3s ease;
            color: white;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        .feature-card-icon {
            font-size: 40px;
            color: rgba(255, 255, 255, 0.9);
        }

        .feature-card-title {
            font-weight: 700;
            font-size: 18px;
            color: white;
        }

        .feature-card-desc {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.6;
            margin: 0;
        }

        /* Footer */
        footer {
            max-width: 1200px;
            margin: 60px auto 0;
            color: rgba(255, 255, 255, 0.75);
            text-align: center;
            padding: 30px clamp(20px, 4vw, 40px) 40px;
            position: relative;
            z-index: 1;
            font-size: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        footer a {
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            h1.hero-title {
                font-size: clamp(28px, 5vw, 40px);
            }
        }

        @media (max-width: 768px) {
            .hero {
                margin: 40px auto;
                padding: 20px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .demo-card {
                margin-top: 30px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0;
            }

            .hero {
                margin: 30px auto;
                padding: 16px;
            }

            .hero-ctas {
                flex-direction: column;
                gap: 10px;
            }

            .btn-cta {
                width: 100%;
                justify-content: center;
            }

            .demo-card {
                padding: 20px;
            }

            .section-title {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-left slide-left delay-1">
            <div class="eyebrow">
                <i class="bi bi-lightning-fill"></i> Sistem Manajemen Absensi
            </div>
            <h1 class="hero-title">Kelola Kehadiran Siswa dengan Lebih Mudah & Efisien</h1>
            <p class="lead">AbsenKelas adalah solusi lengkap untuk manajemen absensi siswa, laporan realtime,
                analytics mendalam, dan export data dalam berbagai format.</p>

            <div class="hero-ctas">
                <a href="{{ route('login') }}" class="btn btn-cta btn-primary-hero">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-cta btn-outline-hero">
                    <i class="bi bi-person-plus"></i> Daftar Akun Baru
                </a>
            </div>

            <div class="hero-features">
                <div class="hero-feature-item delay-2">
                    <i class="bi bi-speedometer2"></i>
                    <span><strong>Dashboard Interaktif</strong> dengan analytics real-time</span>
                </div>
                <div class="hero-feature-item delay-2">
                    <i class="bi bi-people-fill"></i>
                    <span><strong>Manajemen Lengkap</strong> siswa, kelas & guru</span>
                </div>
                <div class="hero-feature-item delay-3">
                    <i class="bi bi-clipboard-check"></i>
                    <span><strong>Input Cepat</strong> dengan status & catatan</span>
                </div>
                <div class="hero-feature-item delay-3">
                    <i class="bi bi-file-earmark-pdf"></i>
                    <span><strong>Export Instant</strong> ke PDF & Excel</span>
                </div>
            </div>
        </div>

        <div class="hero-right slide-right delay-1">
            <div class="demo-card">
                <div class="demo-card-header">
                    <div class="demo-card-icon"><i class="bi bi-calendar-check"></i></div>
                    <div>
                        <h2 class="demo-card-title">Akun Demo</h2>
                        <p class="demo-card-desc">Coba fitur lengkap sekarang juga</p>
                    </div>
                </div>

                <div class="demo-credentials">
                    <div class="demo-credentials-title">👤 Admin</div>
                    <div class="credential-item">
                        <span class="credential-label">Email:</span> admin@test.com
                    </div>
                    <div class="credential-item">
                        <span class="credential-label">Pass:</span> admin123
                    </div>
                </div>

                <div class="demo-credentials">
                    <div class="demo-credentials-title">👨‍🏫 Guru/Pengajar</div>
                    <div class="credential-item">
                        <span class="credential-label">Email:</span> guru1@test.com
                    </div>
                    <div class="credential-item">
                        <span class="credential-label">Pass:</span> guru123
                    </div>
                </div>

                <div class="demo-note">
                    <i class="bi bi-info-circle"></i>
                    <span>Data demo direset setiap hari untuk keamanan. Silakan buat akun sendiri untuk data
                        permanen.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <h2 class="section-title fade-up delay-1">Fitur-Fitur Unggulan</h2>
        <div class="features-grid">
            <div class="feature-card fade-up delay-1">
                <div class="feature-card-icon"><i class="bi bi-graph-up"></i></div>
                <h3 class="feature-card-title">Dashboard Analytics</h3>
                <p class="feature-card-desc">Monitor absensi siswa secara realtime dengan grafik interaktif dan
                    statistik mendalam untuk membantu pengambilan keputusan.</p>
            </div>

            <div class="feature-card fade-up delay-2">
                <div class="feature-card-icon"><i class="bi bi-database"></i></div>
                <h3 class="feature-card-title">Database Terpusat</h3>
                <p class="feature-card-desc">Manajemen data siswa, kelas, dan absensi dalam satu platform yang
                    terorganisir dan mudah diakses kapan saja.</p>
            </div>

            <div class="feature-card fade-up delay-3">
                <div class="feature-card-icon"><i class="bi bi-file-earmark-spreadsheet"></i></div>
                <h3 class="feature-card-title">Export Multi-Format</h3>
                <p class="feature-card-desc">Ekspor laporan absensi ke format PDF atau Excel dengan layout professional
                    dan data yang akurat untuk arsip sekolah.</p>
            </div>

            <div class="feature-card fade-up delay-1">
                <div class="feature-card-icon"><i class="bi bi-shield-check"></i></div>
                <h3 class="feature-card-title">Sistem Keamanan</h3>
                <p class="feature-card-desc">Autentikasi aman dengan role-based access control untuk memastikan data
                    siswa tetap privat dan terlindungi.</p>
            </div>

            <div class="feature-card fade-up delay-2">
                <div class="feature-card-icon"><i class="bi bi-phone"></i></div>
                <h3 class="feature-card-title">Responsive Design</h3>
                <p class="feature-card-desc">Akses dari desktop, tablet, atau mobile dengan tampilan yang sempurna dan
                    performa optimal di semua perangkat.</p>
            </div>

            <div class="feature-card fade-up delay-3">
                <div class="feature-card-icon"><i class="bi bi-lightning"></i></div>
                <h3 class="feature-card-title">Performance Cepat</h3>
                <p class="feature-card-desc">Interface responsif dengan loading time minimal untuk pengalaman pengguna
                    yang smooth dan produktivitas maksimal.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; <strong>{{ date('Y') }} AbsenKelas</strong> | Sistem Manajemen Absensi Siswa | Dibuat dengan <i
                class="bi bi-heart-fill"></i> untuk pendidikan yang lebih baik</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll untuk link
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
