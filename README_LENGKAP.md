# 📚 Aplikasi Digital Absensi Kelas

Sistem Informasi Digital untuk Manajemen Kehadiran Siswa berbasis Laravel 12

## 🎯 Deskripsi Singkat

Aplikasi Absensi Kelas adalah sistem informasi berbasis web yang dirancang untuk memudahkan guru dan admin dalam mengelola data absensi siswa secara digital. Aplikasi ini menyediakan fitur lengkap mulai dari manajemen data master (guru, siswa, kelas) hingga pelaporan dengan export PDF dan Excel.

## ✨ Fitur Utama

### 1. Autentikasi & Role Management
- Login untuk Admin dan Guru dengan role berbeda
- Registrasi guru baru
- Manajemen sesi dan password

### 2. Master Data Management
- **Guru**: CRUD data guru dengan NIP unik
- **Kelas**: Manajemen kelas dengan guru pengampu
- **Siswa**: Data siswa per kelas dengan informasi lengkap

### 3. Manajemen Absensi
- Input absensi dengan 4 status: Hadir, Sakit, Izin, Alpa
- Bulk action untuk multiple siswa
- Validasi duplikasi absensi
- Update/delete absensi

### 4. Filter & Pencarian
- Filter berdasarkan kelas
- Filter range tanggal
- Filter status absensi
- Pagination otomatis

### 5. Dashboard & Analytics
- Dashboard khusus Admin dan Guru
- Statistik jumlah guru, siswa, kelas
- Chart doughnut (status absensi)
- Chart line (trend per hari)
- Data real-time

### 6. Export Laporan
- Export ke PDF
- Export ke Excel (CSV)
- Filter sebelum export
- Download otomatis

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.3+)
- **Database**: SQLite
- **Frontend**: Blade Templates + Bootstrap 5
- **Charts**: Chart.js 3.9
- **Icons**: Bootstrap Icons

## 📋 Requirements

- PHP 8.3 atau lebih tinggi
- Composer
- SQLite (built-in di PHP)
- Browser modern (Chrome, Firefox, Safari, Edge)

## 🚀 Quick Start

### 1. Setup Database
```bash
php artisan migrate:fresh --seed
```

### 2. Jalankan Server
```bash
php artisan serve
```

### 3. Akses Aplikasi
```
http://127.0.0.1:8000
```

### 4. Login dengan Akun Demo
```
Email: admin@test.com
Password: admin123
```

Lihat file `SETUP.md` untuk panduan lengkap!

## 📁 Struktur Folder

```
absen_kelas/
├── app/
│   ├── Http/Controllers/      # Business Logic
│   ├── Models/                # Database Models
│   └── Middleware/
├── database/
│   ├── migrations/            # Database Schema
│   └── seeders/               # Dummy Data
├── resources/
│   └── views/                 # Blade Templates
├── routes/
│   └── web.php                # Route Configuration
├── storage/                   # File Storage
└── .env                       # Environment Config
```

## 📖 Dokumentasi Lengkap

Lihat file **SETUP.md** untuk:
- Panduan instalasi step-by-step
- Panduan penggunaan setiap fitur
- Akun demo yang tersedia
- Struktur database lengkap
- Troubleshooting
- Command useful
- Testing checklist

## 🔐 Keamanan

- ✅ Password hashing dengan bcrypt
- ✅ CSRF protection (Laravel built-in)
- ✅ Role-based access control
- ✅ Input validation
- ✅ SQL injection protection

## 📊 Database Schema

Tabel utama:
- `users` - Akun login
- `gurus` - Data guru
- `kelas` - Data kelas
- `siswas` - Data siswa
- `absensi` - Data absensi

## 👨‍💻 Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@test.com | admin123 |
| Guru 1 | guru1@test.com | guru123 |
| Guru 2 | guru2@test.com | guru123 |
| Guru 3 | guru3@test.com | guru123 |

## 🎨 UI/UX Features

- Responsive design (mobile, tablet, desktop)
- Modern dashboard dengan gradient
- Sidebar navigation yang intuitif
- Data tables dengan pagination
- Modal forms untuk input data
- Alert notifications untuk feedback
- Breadcrumb navigation
- Consistent color scheme

## 📱 Browser Compatibility

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+

## 🐛 Known Issues & Solutions

Lihat bagian **Troubleshooting** di file SETUP.md

## 🔄 Update & Maintenance

### Backup Database
```bash
# SQLite database tersimpan di:
storage/app.sqlite
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
```

## 📝 Changelog

### v1.0.0 (2024)
- Initial release
- Semua fitur utama sudah implemented
- Database seeded dengan dummy data

## 📄 Lisensi

Project ini dibuat untuk tujuan edukasi.

## 🙏 Terima Kasih

Dibuat menggunakan:
- Laravel Framework
- Bootstrap CSS Framework
- Chart.js Library

## 📞 Kontak & Support

Untuk bantuan lebih lanjut, lihat dokumentasi di SETUP.md atau Laravel official docs.

---

**Dibuat dengan ❤️ menggunakan Laravel 12**

Selamat menggunakan aplikasi absensi kelas! 🎉
