# Aplikasi Digital Absensi Kelas - Panduan Setup & Penggunaan

## 📋 Daftar Isi
1. [Fitur Aplikasi](#fitur-aplikasi)
2. [Persyaratan Sistem](#persyaratan-sistem)
3. [Instalasi & Setup](#instalasi--setup)
4. [Akun Demo](#akun-demo)
5. [Panduan Penggunaan](#panduan-penggunaan)
6. [Fitur Utama](#fitur-utama)
7. [Struktur Database](#struktur-database)
8. [Troubleshooting](#troubleshooting)

---

## 🎯 Fitur Aplikasi

### Fitur Utama:
- ✅ **Manajemen Admin & Guru**
  - Dashboard khusus untuk Admin dan Guru
  - CRUD data guru dengan autentikasi berbeda
  - Role-based access control (RBAC)

- ✅ **CRUD Siswa**
  - Tambah, edit, hapus data siswa
  - Data per kelas dengan informasi lengkap
  - NIS unik untuk setiap siswa

- ✅ **CRUD Kelas**
  - Manajemen data kelas (X, XI, XII)
  - Tetapkan guru untuk setiap kelas
  - Informasi jurusan dan kapasitas

- ✅ **Input Absensi Per Kelas**
  - Input absensi dengan 4 status: Hadir, Sakit, Izin, Alpa
  - Bulk action untuk mengubah status semua siswa sekaligus
  - Input keterangan untuk alasan ketidakhadiran

- ✅ **Filter Tanggal & Status**
  - Filter berdasarkan tanggal mulai-akhir
  - Filter per kelas dan status absensi
  - Search dan pagination otomatis

- ✅ **Export PDF & Excel**
  - Export laporan absensi ke PDF
  - Export laporan absensi ke CSV/Excel
  - Laporan dapat difilter sebelum export

- ✅ **Dashboard dengan Grafik**
  - Statistik jumlah guru, siswa, kelas
  - Chart absensi status (Hadir/Sakit/Izin/Alpa)
  - Chart trend absensi per hari
  - Data real-time yang update otomatis

---

## 💻 Persyaratan Sistem

### Software yang Diperlukan:
- **PHP 8.3+** (sudah terinstal di XAMPP)
- **MySQL/SQLite** (SQLite digunakan dalam project ini)
- **Composer** (untuk dependency management)
- **Node.js + npm** (opsional, untuk asset compilation)
- **Laravel 12.x**

### File Konfigurasi:
- `.env` - Konfigurasi environment

---

## 🔧 Instalasi & Setup

### Step 1: Clone/Setup Project
```bash
# Jika belum ada, folder sudah siap di:
cd c:\xampp\htdocs\absen_kelas
```

### Step 2: Install Dependencies
```bash
# Jika dependencies belum terinstall:
composer install
```

### Step 3: Setup Environment
```bash
# Copy file .env (sudah ada)
# Pastikan konfigurasi sudah benar:
APP_NAME="Absensi Kelas"
APP_ENV=local
APP_KEY=base64:xxx (sudah ada)
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database (SQLite sudah dikonfigurasi)
DB_CONNECTION=sqlite
```

### Step 4: Setup Database
```bash
# Fresh migration (hapus tabel lama dan buat baru)
php artisan migrate:fresh

# Seed database dengan data dummy
php artisan db:seed
```

### Step 5: Jalankan Server Development
```bash
# Terminal 1: Jalankan server Laravel
php artisan serve

# Server akan berjalan di http://127.0.0.1:8000
```

### Step 6: Akses Aplikasi
Buka browser dan akses:
```
http://127.0.0.1:8000
```

---

## 🔐 Akun Demo

### Admin Account (Akses Full):
```
Email: admin@test.com
Password: admin123
Role: Administrator
```

### Guru Accounts:
```
Guru 1:
Email: guru1@test.com
Password: guru123
NIP: 123456701

Guru 2:
Email: guru2@test.com
Password: guru123
NIP: 123456702

Guru 3:
Email: guru3@test.com
Password: guru123
NIP: 123456703
```

---

## 📖 Panduan Penggunaan

### 1. Login ke Sistem
1. Akses halaman login: `http://127.0.0.1:8000/login`
2. Masukkan email dan password (lihat akun demo)
3. Klik "Login"

### 2. Dashboard
Setelah login, Anda akan melihat dashboard dengan:
- **Untuk Admin**: Total guru, siswa, kelas, dan absensi
- **Untuk Guru**: Total kelas yang diampu, siswa, dan absensi
- Grafik statistik absensi
- Link menu untuk mengelola data

### 3. Manajemen Guru (Admin Only)
```
Menu: Guru → Data Guru

Fitur:
- Lihat daftar semua guru
- Tambah guru baru (dengan NIP unik)
- Edit data guru
- Hapus guru (akan menghapus juga user terkait)
```

### 4. Manajemen Kelas
```
Menu: Kelas → Data Kelas

Fitur:
- Lihat semua kelas
- Tambah kelas baru (pilih guru pengampu)
- Edit data kelas
- Hapus kelas
- Lihat detail siswa di kelas
```

### 5. Manajemen Siswa
```
Menu: Siswa → Data Siswa

Fitur:
- Lihat semua siswa (dengan filter per kelas jika guru)
- Tambah siswa baru (pilih kelas)
- Edit data siswa
- Hapus siswa
- Data meliputi: NIS, nama, gender, tanggal lahir, alamat, no telp, orang tua
```

### 6. Input Absensi (Fitur Utama)
```
Menu: Absensi → Input Absensi

Langkah-langkah:
1. Pilih kelas
2. Pilih tanggal absensi
3. Sistem otomatis menampilkan daftar siswa
4. Ubah status per siswa atau gunakan tombol:
   - "Semua Hadir"
   - "Semua Sakit"
   - "Semua Izin"
   - "Semua Alpa"
5. Tambahkan keterangan jika diperlukan
6. Klik "Simpan Absensi"

Status Absensi:
- Hadir (Hijau)
- Sakit (Kuning)
- Izin (Biru)
- Alpa (Merah)
```

### 7. Lihat & Filter Data Absensi
```
Menu: Absensi → Lihat Data

Fitur Filter:
- Kelas (dropdown)
- Tanggal Mulai - Tanggal Akhir
- Status (Hadir/Sakit/Izin/Alpa)
- Tombol Filter dan Reset

Fitur Additional:
- Pagination (15 data per halaman)
- Hapus data absensi individual
```

### 8. Export Laporan
```
Dari menu Absensi:
1. Atur filter sesuai kebutuhan
2. Klik tombol "Export" di kanan atas
3. Pilih format:
   - PDF (format tabel HTML to PDF)
   - Excel (format CSV yang dapat dibuka di Excel)

File akan otomatis diunduh
```

### 9. Logout
```
Klik username di navbar → Logout
Atau gunakan tombol logout di sidebar
```

---

## 🎨 Fitur Utama Detailed

### Dashboard Admin:
- 📊 Total Guru, Siswa, Kelas
- 📈 Chart status absensi bulan ini
- 📉 Chart trend absensi per hari
- 🔍 Statistik real-time

### Dashboard Guru:
- 📊 Total kelas yang diampu
- 👥 Jumlah siswa total
- 📈 Chart absensi kelas-kelas
- 📋 Daftar kelas yang dapat dikelola

### Input Absensi:
- ⚡ Bulk action (set semua siswa sekaligus)
- 📝 Input keterangan per siswa
- ✅ Validasi duplikasi (tidak boleh input 2x untuk 1 siswa di 1 hari)
- 💾 Simpan otomatis

### Filter & Pencarian:
- 🔎 Filter per kelas
- 📅 Range tanggal
- 🏷️ Filter status
- 📄 Pagination otomatis
- 🔄 Reset filter mudah

### Export:
- 📄 PDF dengan tabel rapi
- 📊 Excel CSV format
- 🔗 Preserve filter saat export
- 💾 Auto-download

---

## 📊 Struktur Database

### Tabel Users
```
- id (Primary Key)
- name (Nama user)
- email (Email unik)
- password (Hashed)
- role (admin / guru)
- timestamps
```

### Tabel Gurus
```
- id (Primary Key)
- user_id (Foreign Key ke users)
- nip (Nomor Identitas Pegawai - unik)
- nama_lengkap
- email
- no_telp
- alamat
- timestamps
```

### Tabel Kelas
```
- id (Primary Key)
- guru_id (Foreign Key ke gurus)
- nama_kelas (unik)
- tingkat (X, XI, XII)
- jurusan (misal: RPL, TKJ)
- kapasitas
- timestamps
```

### Tabel Siswas
```
- id (Primary Key)
- kelas_id (Foreign Key ke kelas)
- nis (Nomor Induk Siswa - unik)
- nama_lengkap
- jenis_kelamin (Laki-laki / Perempuan)
- tanggal_lahir
- alamat
- no_telp
- nama_orang_tua
- timestamps
```

### Tabel Absensi
```
- id (Primary Key)
- siswa_id (Foreign Key ke siswas)
- kelas_id (Foreign Key ke kelas)
- guru_id (Foreign Key ke gurus)
- tanggal_absen
- status (Hadir / Sakit / Izin / Alpa)
- keterangan (optional)
- timestamps
- UNIQUE: siswa_id + tanggal_absen (cegah duplikasi)
```

---

## 🚀 Command Useful

### Development
```bash
# Start server
php artisan serve

# Fresh migrate (reset database)
php artisan migrate:fresh

# Seed database
php artisan db:seed

# Fresh migrate + seed
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear

# Tinker (interactive shell)
php artisan tinker
```

### Database
```bash
# Lihat daftar migrations
php artisan migrate:status

# Rollback last migration
php artisan migrate:rollback

# Rollback semua migrations
php artisan migrate:reset
```

### Routes
```bash
# Lihat semua routes
php artisan route:list
```

---

## 🐛 Troubleshooting

### 1. Error: "Class not found"
```
Solusi:
php artisan cache:clear
composer dump-autoload
```

### 2. Error: "SQLSTATE[HY000]: General error"
```
Solusi:
php artisan migrate:fresh --seed
```

### 3. Server tidak bisa diakses di `http://127.0.0.1:8000`
```
Solusi:
- Pastikan server sudah jalan (lihat terminal)
- Gunakan URL: http://localhost:8000 (jika 127.0.0.1 tidak bisa)
- Cek port, jika 8000 sudah terpakai, gunakan:
  php artisan serve --port=8001
```

### 4. File upload/export tidak bekerja
```
Solusi:
- Pastikan folder storage/app/temp ada
- Berikan permission write ke folder storage
- Windows: Biasanya otomatis, tidak perlu chmod
```

### 5. Asset CSS/JS tidak muncul
```
Solusi:
- Refresh page (Ctrl+Shift+R)
- Clear browser cache
- Asset menggunakan CDN, cek internet connection
```

### 6. Login tidak bisa (invalid email/password)
```
Solusi:
- Pastikan sudah seed database: php artisan db:seed
- Gunakan akun demo: admin@test.com / admin123
- Reset password melalui tinker:
  php artisan tinker
  > User::find(1)->update(['password' => Hash::make('admin123')])
```

### 7. Edit/Delete data tidak bekerja
```
Solusi:
- Cek apakah Anda adalah admin atau pemilik data
- Cek browser console untuk error JavaScript
- Refresh page dan coba lagi
```

---

## 📱 Responsive Design

Aplikasi sudah dioptimasi untuk:
- 📱 Mobile (Bootstrap responsive)
- 💻 Tablet
- 🖥️ Desktop
- ⌨️ Keyboard navigation

---

## 🔒 Keamanan

### Fitur Keamanan:
- ✅ Password hashing (bcrypt)
- ✅ CSRF protection (laravel built-in)
- ✅ Role-based middleware
- ✅ Session management
- ✅ Input validation
- ✅ SQL injection protection (prepared statements)

### Best Practices (Production):
- Jangan gunakan APP_DEBUG=true
- Ubah APP_KEY jika di production
- Gunakan HTTPS
- Set secure cookies
- Buat backup database regular
- Update dependencies regular

---

## 📝 Notes

### File Penting:
```
Project Root:
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── GuruController.php
│   │   │   ├── KelasController.php
│   │   │   ├── SiswaController.php
│   │   │   ├── AbsensiController.php
│   │   │   └── ExportController.php
│   │   └── Middleware/RoleMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Guru.php
│       ├── Kelas.php
│       ├── Siswa.php
│       └── Absensi.php
├── database/
│   ├── migrations/ (Schema database)
│   └── seeders/DatabaseSeeder.php (Data dummy)
├── resources/
│   └── views/ (Blade templates)
│       ├── auth/
│       ├── dashboard/
│       ├── guru/
│       ├── kelas/
│       ├── siswa/
│       ├── absensi/
│       └── layouts/
├── routes/
│   └── web.php (Route configuration)
└── .env (Configuration file)
```

### Default Behavior:
- Database: SQLite (database.sqlite di storage folder)
- Session Driver: Database
- Password hashing: Bcrypt
- Timezone: UTC (dapat diubah di .env)

---

## ✅ Testing Checklist

Sebelum deployment:
- [ ] Semua routes berjalan normal
- [ ] Login dengan akun demo berhasil
- [ ] CRUD Guru berfungsi (admin only)
- [ ] CRUD Kelas berfungsi
- [ ] CRUD Siswa berfungsi
- [ ] Input absensi berfungsi
- [ ] Filter absensi berfungsi
- [ ] Export PDF berfungsi
- [ ] Export Excel berfungsi
- [ ] Dashboard tampil dengan benar
- [ ] Grafik chart terbentuk
- [ ] Logout berfungsi
- [ ] Role-based access bekerja
- [ ] Mobile responsive OK

---

## 📞 Support & Dokumentasi

### Laravel Documentation:
- https://laravel.com/docs/12.x

### Bootstrap Documentation:
- https://getbootstrap.com/docs/5.3

### Chart.js Documentation:
- https://www.chartjs.org/docs/latest

---

## 🎉 Aplikasi Siap Digunakan!

Selamat! Anda sudah berhasil setup aplikasi absensi kelas. Sekarang Anda dapat:

1. ✅ Login dengan akun demo
2. ✅ Mengelola data guru, siswa, dan kelas
3. ✅ Input absensi dengan mudah
4. ✅ Melihat statistik di dashboard
5. ✅ Export laporan ke PDF/Excel

Selamat menggunakan! 🚀
