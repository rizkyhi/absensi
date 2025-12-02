# Use Case Diagram - Sistem Informasi Absensi Kelas

## Diagram ASCII Use Case

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                    SISTEM INFORMASI ABSENSI KELAS                           │
│                          USE CASE DIAGRAM                                   │
└─────────────────────────────────────────────────────────────────────────────┘


                            ┌─────────────────┐
                            │   ADMIN/GURU    │
                            └────────┬────────┘
                                     │
                    ┌────────────────┼────────────────┐
                    │                │                │
         ┌──────────▼──────────┐     │                │
         │  Manage Kelas       │     │                │
         │  ├─ Create          │     │                │
         │  ├─ Read            │     │                │
         │  ├─ Update          │     │                │
         │  └─ Delete          │     │                │
         └─────────────────────┘     │                │
                    │                │                │
         ┌──────────▼──────────┐     │                │
         │  Manage Siswa       │     │                │
         │  ├─ Create          │     │                │
         │  ├─ Read            │     │                │
         │  ├─ Update          │     │                │
         │  └─ Delete          │     │                │
         └─────────────────────┘     │                │
                    │                │                │
         ┌──────────▼──────────┐     │                │
         │  Record Absensi     │◄────┼────────────────┤
         │  ├─ Input           │     │                │
         │  ├─ Edit            │     │                │
         │  └─ Delete          │     │                │
         └─────────────────────┘     │                │
                    │                │                │
         ┌──────────▼──────────┐     │                │
         │  View Report        │◄────┼────────────────┤
         │  ├─ Attendance      │     │                │
         │  ├─ Statistics      │     │                │
         │  └─ Export Data     │     │                │
         └─────────────────────┘     │                │
                    │                │                │
         ┌──────────▼──────────┐     │                │
         │  Authentication     │◄────┼────────────────┤
         │  ├─ Login           │     │                │
         │  ├─ Logout          │     │                │
         │  └─ Change Password │     │                │
         └─────────────────────┘     │                │
                    │                │                │
         ┌──────────▼──────────┐     │                │
         │  Manage Account     │◄────┼────────────────┤
         │  ├─ View Profile    │     │                │
         │  ├─ Edit Profile    │     │                │
         │  └─ Manage User     │     │                │
         └─────────────────────┘     │                │
                                     │                │
                                     │                │
                            ┌────────▼────────┐      │
                            │  SYSTEM ADMIN   │      │
                            └────────┬────────┘      │
                                     │               │
                        ┌────────────┼───────────┐   │
                        │            │           │   │
         ┌──────────────▼────┐  ┌────▼─────────┐│   │
         │ Manage All User   │  │ System Config ││   │
         │ ├─ Create         │  │ ├─ Settings  ││   │
         │ ├─ Read           │  │ └─ Backup    ││   │
         │ ├─ Update         │  └────────────────┘   │
         │ └─ Delete         │                       │
         └───────────────────┘                       │
                                                     │
                            ┌────────────────────────┘
                            │
                     ┌──────▼──────┐
                     │   SISWA     │
                     └─────┬───────┘
                           │
                     ┌─────▼─────┐
                     │ View Own   │
                     │ Attendance │
                     └───────────┘


```

---

## Daftar Use Case Lengkap

### 1. **Authentication & Authorization**

| Use Case        | Aktor            | Deskripsi                                  |
| --------------- | ---------------- | ------------------------------------------ |
| Login           | Admin/Guru/Siswa | Masuk ke sistem dengan username & password |
| Logout          | Admin/Guru/Siswa | Keluar dari sistem                         |
| Change Password | Admin/Guru/Siswa | Mengubah password akun                     |
| Reset Password  | Admin            | Mereset password user lain                 |

---

### 2. **Manage Kelas (Rombongan Belajar)**

| Use Case          | Aktor      | Deskripsi                      | Precondition                     |
| ----------------- | ---------- | ------------------------------ | -------------------------------- |
| Create Kelas      | Admin      | Menambah kelas baru            | User sudah login                 |
| View Kelas        | Admin/Guru | Melihat daftar semua kelas     | User sudah login                 |
| Update Kelas      | Admin      | Mengubah data kelas            | Kelas sudah ada                  |
| Delete Kelas      | Admin      | Menghapus kelas & data terkait | Kelas tidak memiliki siswa aktif |
| View Kelas Detail | Admin/Guru | Melihat detail kelas + siswa   | Kelas ada                        |

**Attributes:**

-   nama_kelas (required, unique)
-   tingkat (X, XI, XII)
-   jurusan (RPL, TKJ, dll)
-   kapasitas (default: 30)

---

### 3. **Manage Siswa**

| Use Case          | Aktor      | Deskripsi                          | Precondition          |
| ----------------- | ---------- | ---------------------------------- | --------------------- |
| Create Siswa      | Admin      | Menambah siswa baru ke kelas       | Kelas sudah ada       |
| View Siswa        | Admin/Guru | Melihat daftar siswa               | User sudah login      |
| Update Siswa      | Admin      | Mengubah data siswa                | Siswa sudah ada       |
| Delete Siswa      | Admin      | Menghapus siswa dari kelas         | Siswa ada di database |
| View Siswa Detail | Admin/Guru | Melihat detail profil siswa        | Siswa ada             |
| Search Siswa      | Admin/Guru | Mencari siswa berdasarkan NIS/nama | -                     |

**Attributes:**

-   NIS (unique)
-   Nama lengkap
-   Jenis kelamin
-   Tanggal lahir
-   Alamat
-   No. telp
-   Nama orang tua
-   Kelas_id (foreign key)

---

### 4. **Record & Manage Absensi**

| Use Case                 | Aktor      | Deskripsi                         | Precondition          |
| ------------------------ | ---------- | --------------------------------- | --------------------- |
| Input Absensi            | Guru       | Mencatat kehadiran siswa per hari | Kelas & siswa ada     |
| Edit Absensi             | Guru/Admin | Mengubah status kehadiran         | Record absensi ada    |
| Delete Absensi           | Admin      | Menghapus record absensi          | Record ada            |
| View Absensi             | Guru/Admin | Melihat daftar absensi kelas      | Absensi sudah dicatat |
| View Personal Attendance | Siswa      | Melihat riwayat kehadiran pribadi | User adalah siswa     |

**Attributes:**

-   siswa_id (FK)
-   kelas_id (FK)
-   tanggal_absen
-   status (Hadir, Sakit, Izin, Alpa)
-   keterangan (optional)
-   Unique: (siswa_id, tanggal_absen)

---

### 5. **View Reports & Analytics**

| Use Case           | Aktor      | Deskripsi                          | Output          |
| ------------------ | ---------- | ---------------------------------- | --------------- |
| Attendance Report  | Admin/Guru | Laporan kehadiran per siswa        | Tabel/PDF       |
| Statistics         | Admin/Guru | Statistik kehadiran (%, rata-rata) | Chart/Dashboard |
| Export Data        | Admin      | Mengekspor data ke Excel/CSV       | File            |
| Attendance Summary | Guru       | Ringkasan absensi kelas per bulan  | Report          |

---

### 6. **Manage User Account**

| Use Case     | Aktor            | Deskripsi                   | Precondition      |
| ------------ | ---------------- | --------------------------- | ----------------- |
| View Profile | Admin/Guru/Siswa | Melihat data profil pribadi | User sudah login  |
| Edit Profile | Admin/Guru/Siswa | Mengubah data profil        | User sudah login  |
| Create User  | Admin            | Menambah user baru          | Admin sudah login |
| Manage User  | Admin            | Melihat & kelola semua user | Admin sudah login |
| Delete User  | Admin            | Menghapus akun user         | User tidak aktif  |

---

### 7. **System Administration**

| Use Case             | Aktor        | Deskripsi                | Privilege        |
| -------------------- | ------------ | ------------------------ | ---------------- |
| System Configuration | System Admin | Mengatur setting sistem  | Super admin only |
| Database Backup      | System Admin | Backup database          | Super admin only |
| View Logs            | System Admin | Melihat sistem logs      | Super admin only |
| Manage Roles         | System Admin | Kelola role & permission | Super admin only |

---

## Actor Definition

### 1. **Admin**

-   **Deskripsi:** Pengelola sistem utama
-   **Tanggung Jawab:**
    -   Manage kelas (CRUD)
    -   Manage siswa (CRUD)
    -   Manage user/guru
    -   View reports & analytics
    -   Delete data yang tidak diperlukan
-   **Privilege:** Akses penuh ke semua modul kecuali sistem config

### 2. **Guru**

-   **Deskripsi:** Pengajar yang mencatat kehadiran
-   **Tanggung Jawab:**
    -   Record kehadiran siswa
    -   Edit/delete absensi
    -   Melihat laporan kehadiran kelas
    -   View statistik kelas
-   **Privilege:** CRUD absensi, Read kelas & siswa

### 3. **Siswa**

-   **Deskripsi:** Pelajar yang di-track kehadirannya
-   **Tanggung Jawab:**
    -   Melihat riwayat kehadiran pribadi
    -   Update profil pribadi
-   **Privilege:** Read-only untuk data pribadi

### 4. **System Admin** (opsional)

-   **Deskripsi:** Administrator sistem
-   **Tanggung Jawab:**
    -   Konfigurasi sistem
    -   Backup & restore database
    -   Monitor system logs
    -   Manage roles & permissions

---

## Relationships & Associations

### Includes (extends functionality)

```
Input Absensi [includes] → Validate Unique (siswa_id, tanggal_absen)
Delete Kelas  [includes] → Cascade Delete Siswa & Absensi
Create User   [includes] → Generate Default Password
```

### Extends (optional behavior)

```
Edit Absensi [extends] → View History Changes
View Absensi [extends] → Print Report
Export Data  [extends] → Format Conversion
```

### Inheritance

```
Manage Kelas
├─ Create Kelas
├─ View Kelas
├─ Update Kelas
└─ Delete Kelas

Manage Siswa
├─ Create Siswa
├─ View Siswa
├─ Update Siswa
└─ Delete Siswa
```

---

## Scenarios & Workflows

### Scenario 1: Input Kehadiran Harian

```
1. Guru login ke sistem
2. Pilih Kelas: "X-RPL-1"
3. Pilih Tanggal: "2024-12-02"
4. Sistem load daftar siswa di kelas tersebut
5. Guru input status setiap siswa:
   - Siswa 1: Hadir ✓
   - Siswa 2: Sakit (input keterangan)
   - Siswa 3: Izin (input keterangan)
   - Siswa 4: Alpa
6. Guru submit/save
7. Sistem validasi: unique (siswa_id, tanggal)
8. Data tersimpan ke table ABSENSI
9. Guru melihat konfirmasi sukses
```

### Scenario 2: Hapus Kelas & Cascade Delete

```
1. Admin login
2. Navigasi ke Manage Kelas
3. Cari Kelas: "X-TKJ-2" (id=15)
4. Klik tombol Hapus
5. Sistem tampil konfirmasi: "Tindakan ini akan menghapus:"
   - Kelas X-TKJ-2
   - 30 siswa di kelas
   - 150 record absensi
6. Admin konfirmasi
7. Sistem:
   - Delete KELAS where id=15
   - Cascade delete SISWA where kelas_id=15
   - Cascade delete ABSENSI where kelas_id=15
8. Sistem tampil pesan sukses
9. Kelas hilang dari list
```

### Scenario 3: Export Attendance Report

```
1. Guru login
2. Navigasi ke Reports
3. Pilih Kelas: "X-RPL-1"
4. Pilih Rentang Tanggal: "01-12-2024" s/d "30-12-2024"
5. Klik "Export ke Excel"
6. Sistem generate file:
   - Nama: Absensi_X-RPL-1_Des2024.xlsx
   - Kolom: NIS, Nama, Hadir, Sakit, Izin, Alpa, Total, %
7. File download ke komputer guru
```

### Scenario 4: Student View Own Attendance

```
1. Siswa login ke sistem
2. Dashboard tampil: Welcome + Quick Stats
3. Siswa klik "Riwayat Kehadiran"
4. Sistem tampil:
   - Calendar view dengan marker kehadiran
   - Atau List view dengan filter
5. Siswa bisa lihat:
   - Total hadir/sakit/izin/alpa
   - Persentase kehadiran
   - Tren kehadiran
6. Siswa bisa filter per bulan
```

---

## Pre-conditions & Post-conditions

### Create Kelas

```
Pre-conditions:
- Admin sudah login
- Nama kelas belum ada di database

Post-conditions:
- Kelas baru tersimpan
- Kelas siap menerima siswa
- System log mencatat event
```

### Delete Kelas

```
Pre-conditions:
- Admin sudah login
- Kelas sudah ada di database
- User confirm aksi delete

Post-conditions:
- Kelas terhapus
- Semua siswa di kelas terhapus (cascade)
- Semua absensi siswa terhapus (cascade)
- System log mencatat event & backup data
```

### Input Absensi

```
Pre-conditions:
- Guru sudah login
- Kelas ada
- Semua siswa sudah terdaftar di kelas
- Tanggal absen belum ada untuk kelas tersebut

Post-conditions:
- Absensi tersimpan untuk semua siswa
- Unique constraint (siswa_id, tanggal) terpenuhi
- Report otomatis update
```

---

## Alternative Flows & Exceptions

### Exception: Delete Kelas Gagal

```
Jika ada constraint violation atau error:
1. Sistem tangkap exception
2. Log error
3. Tampilkan user-friendly message
4. Opsi: Retry atau Back to List
```

### Alternative: Edit Vs Delete Absensi

```
Primary Flow: Guru bisa edit absensi langsung
Alternative: Guru delete dan re-input absensi baru
```

### Alternative: Bulk Upload Siswa

```
Primary Flow: Input siswa satu per satu
Alternative: Admin upload file CSV dengan siswa list
```

---

## Summary Table

| Aspek              | Detail                            |
| ------------------ | --------------------------------- |
| Total Use Cases    | 20+                               |
| Total Actors       | 4 (Admin, Guru, Siswa, Sys Admin) |
| Critical Use Cases | Delete Kelas, Input Absensi       |
| Cascade Operations | Delete Kelas → Siswa → Absensi    |
| External Systems   | Mungkin: Email, Report Generator  |
| Authentication     | Username/Password + Role-based    |
| Audit Trail        | Semua operasi di-log              |

---

## Modul Development Priority

### Phase 1 (Must Have)

-   [ ] Authentication & Login
-   [ ] Manage Kelas (CRUD)
-   [ ] Manage Siswa (CRUD)
-   [ ] Record Absensi

### Phase 2 (Should Have)

-   [ ] View Reports
-   [ ] Export Data
-   [ ] Statistics/Analytics

### Phase 3 (Nice to Have)

-   [ ] Siswa view own attendance
-   [ ] Bulk upload
-   [ ] Email notifications
-   [ ] Advanced filters
