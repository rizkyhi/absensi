# 🚀 Quick Reference Guide - Aplikasi Absensi Kelas

## ⚡ Startup Commands

```bash
# Terminal 1: Jalankan server
cd c:\xampp\htdocs\absen_kelas
php artisan serve

# Server berjalan di: http://127.0.0.1:8000
```

## 🔐 Login Credentials

| Akun | Email | Password |
|------|-------|----------|
| Admin | admin@test.com | admin123 |
| Guru 1 | guru1@test.com | guru123 |
| Guru 2 | guru2@test.com | guru123 |

## 📍 Main URL Routes

```
GET  /                          Halaman utama / welcome
GET  /login                     Form login
POST /login                     Process login
GET  /register                  Form register
POST /register                  Process register
GET  /dashboard                 Dashboard (admin/guru)
POST /logout                    Logout

CRUD Guru (Admin Only):
GET  /guru                      Daftar guru
GET  /guru/create               Form tambah guru
POST /guru                      Simpan guru
GET  /guru/{id}/edit            Form edit guru
PUT  /guru/{id}                 Update guru
DELETE /guru/{id}               Hapus guru

CRUD Kelas:
GET  /kelas                     Daftar kelas
GET  /kelas/create              Form tambah kelas
POST /kelas                     Simpan kelas
GET  /kelas/{id}                Detail kelas
GET  /kelas/{id}/edit           Form edit kelas
PUT  /kelas/{id}                Update kelas
DELETE /kelas/{id}              Hapus kelas

CRUD Siswa:
GET  /siswa                     Daftar siswa
GET  /siswa/create              Form tambah siswa
POST /siswa                     Simpan siswa
GET  /siswa/{id}/edit           Form edit siswa
PUT  /siswa/{id}                Update siswa
DELETE /siswa/{id}              Hapus siswa

CRUD Absensi:
GET  /absensi                   Daftar absensi + filter
GET  /absensi/create            Form input absensi
POST /absensi                   Simpan absensi
GET  /absensi/{id}              (future)
GET  /absensi/{id}/edit         (future)
PUT  /absensi/{id}              Update absensi
DELETE /absensi/{id}            Hapus absensi
GET  /absensi/get-siswa/{id}    API: get siswa by kelas (JSON)

Export:
GET  /export/pdf                Export absensi ke PDF
GET  /export/excel              Export absensi ke Excel
```

## 🗂️ Important Files

```
app/Http/Controllers/
  └── Auth/AuthController.php       - Login/Register logic
  └── DashboardController.php        - Dashboard logic
  └── GuruController.php             - Guru CRUD
  └── KelasController.php            - Kelas CRUD
  └── SiswaController.php            - Siswa CRUD
  └── AbsensiController.php          - Absensi CRUD
  └── ExportController.php           - Export PDF/Excel

app/Models/
  └── User.php                       - User model + relations
  └── Guru.php                       - Guru model
  └── Kelas.php                      - Kelas model
  └── Siswa.php                      - Siswa model
  └── Absensi.php                    - Absensi model

database/migrations/
  └── *_create_gurus_table.php       - Gurus table schema
  └── *_create_kelas_table.php       - Kelas table schema
  └── *_create_siswas_table.php      - Siswas table schema
  └── *_create_absensi_table.php     - Absensi table schema

routes/
  └── web.php                        - All routes

resources/views/
  └── auth/login.blade.php           - Login page
  └── auth/register.blade.php        - Register page
  └── dashboard/admin.blade.php      - Admin dashboard
  └── dashboard/guru.blade.php       - Guru dashboard
  └── guru/*.blade.php               - Guru CRUD views
  └── kelas/*.blade.php              - Kelas CRUD views
  └── siswa/*.blade.php              - Siswa CRUD views
  └── absensi/*.blade.php            - Absensi views

bootstrap/app.php                    - App configuration (middleware registered)
```

## 🛠️ Useful Artisan Commands

```bash
# Server
php artisan serve                     # Start server di localhost:8000
php artisan serve --port=8001         # Start server di port 8001

# Database
php artisan migrate                   # Run migrations
php artisan migrate:fresh             # Reset database
php artisan migrate:fresh --seed      # Reset + seed dummy data
php artisan db:seed                   # Seed database only

# Cache & Config
php artisan cache:clear               # Clear cache
php artisan config:clear              # Clear config cache
php artisan route:list                # List all routes

# Interactive
php artisan tinker                    # Interactive shell

# Troubleshooting
php artisan migrate:status            # Check migration status
composer dump-autoload                # Regenerate autoload
php artisan key:generate              # Generate APP_KEY
```

## 📝 Database Tables Quick Ref

### Users Table
```sql
id | name | email | password | role | email_verified_at | remember_token | created_at | updated_at
```

### Gurus Table
```sql
id | user_id | nip | nama_lengkap | email | no_telp | alamat | created_at | updated_at
```

### Kelas Table
```sql
id | guru_id | nama_kelas | tingkat | jurusan | kapasitas | created_at | updated_at
```

### Siswas Table
```sql
id | kelas_id | nis | nama_lengkap | jenis_kelamin | tanggal_lahir | alamat | no_telp | nama_orang_tua | created_at | updated_at
```

### Absensi Table
```sql
id | siswa_id | kelas_id | guru_id | tanggal_absen | status | keterangan | created_at | updated_at
```

## 🎨 Color Scheme

```
Primary: #667eea (Biru Indigo)
Secondary: #764ba2 (Ungu)
Success: #28a745 (Hijau) - Hadir
Warning: #ffc107 (Kuning) - Sakit
Info: #17a2b8 (Biru Cyan) - Izin
Danger: #dc3545 (Merah) - Alpa
Light: #f8f9fa
```

## 🔑 Key Features Summary

| Fitur | Admin | Guru | Unauthenticated |
|-------|-------|------|-----------------|
| Login | ✅ | ✅ | ✅ |
| Register | ✅ | ✅ | ✅ |
| Dashboard | ✅ | ✅ | ❌ |
| Manajemen Guru | ✅ | ❌ | ❌ |
| CRUD Kelas | ✅ | ✅ (own only) | ❌ |
| CRUD Siswa | ✅ | ✅ (own only) | ❌ |
| Input Absensi | ✅ | ✅ (own kelas) | ❌ |
| Filter Absensi | ✅ (all) | ✅ (own) | ❌ |
| Export PDF | ✅ (all) | ✅ (own) | ❌ |
| Export Excel | ✅ (all) | ✅ (own) | ❌ |
| Chart Dashboard | ✅ | ✅ | ❌ |

## 🔒 Middleware

```
auth              - Cek user sudah login
role:{role}       - Cek role user (admin/guru)
guest             - Hanya untuk user belum login
```

## 📊 API Endpoints (JSON)

### Get Siswa by Kelas
```
GET /absensi/get-siswa/{kelasId}

Response:
[
  {
    "id": 1,
    "nis": "00001",
    "nama_lengkap": "Siswa 1",
    "kelas_id": 1,
    "jenis_kelamin": "Laki-laki",
    ...
  }
]
```

## 🐛 Common Issues & Quick Fixes

| Issue | Solution |
|-------|----------|
| "Class not found" | `php artisan cache:clear` + `composer dump-autoload` |
| Database error | `php artisan migrate:fresh --seed` |
| Port 8000 busy | `php artisan serve --port=8001` |
| Asset tidak muncul | Refresh browser (Ctrl+Shift+R) |
| Login gagal | Pastikan seed sudah jalan: `php artisan db:seed` |
| Edit/delete tidak bisa | Cek role, pastikan punya akses |

## 📱 Browser DevTools Tips

```
F12                           Buka developer tools
Ctrl+Shift+I                  Inspect element
Ctrl+Shift+C                  Select element
Ctrl+Shift+J                  Open console
Ctrl+Shift+K                  Open console (Firefox)
```

## 🚀 Deployment Checklist

- [ ] Change APP_DEBUG to false
- [ ] Set APP_ENV to production
- [ ] Generate new APP_KEY: `php artisan key:generate`
- [ ] Set database credentials di .env
- [ ] Run migrations: `php artisan migrate`
- [ ] Set storage permissions: `chmod -R 755 storage`
- [ ] Optimize: `php artisan optimize`
- [ ] Cache config: `php artisan config:cache`
- [ ] Setup SSL/HTTPS

## 📚 Documentation Files

- `SETUP.md` - Full setup & usage guide
- `README_LENGKAP.md` - Quick start guide
- `FILE_STRUCTURE.md` - File listing
- `QUICK_REFERENCE.md` - This file

---

**Last Updated**: November 27, 2024
**Version**: 1.0.0
**Status**: ✅ Ready for Production
