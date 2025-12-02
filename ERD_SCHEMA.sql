-- ============================================================================
-- ENTITY RELATIONSHIP DIAGRAM - SISTEM INFORMASI ABSENSI KELAS
-- Database Schema Documentation
-- ============================================================================

-- ============================================================================
-- TABLE 1: USERS (Pengguna Sistem)
-- ============================================================================
-- Menyimpan data pengguna yang dapat mengakses sistem (admin/guru)

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'guru') NOT NULL DEFAULT 'guru',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Indexes untuk performa query
    INDEX idx_email (email),
    INDEX idx_role (role)
);

-- ============================================================================
-- TABLE 2: KELAS (Kelas/Rombongan Belajar)
-- ============================================================================
-- Menyimpan data kelas
-- Relasi: 1 Kelas → N Siswa (One to Many)
--         1 Kelas → N Absensi (One to Many)

CREATE TABLE kelas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(255) NOT NULL UNIQUE,
    tingkat VARCHAR(255) NOT NULL COMMENT 'X, XI, XII',
    jurusan VARCHAR(100) NULL COMMENT 'RPL, TKJ, dll',
    kapasitas INT NOT NULL DEFAULT 30,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Indexes untuk performa query
    INDEX idx_tingkat (tingkat),
    INDEX idx_jurusan (jurusan),
    INDEX idx_nama_kelas (nama_kelas)
);

-- ============================================================================
-- TABLE 3: SISWA (Data Siswa)
-- ============================================================================
-- Menyimpan data siswa
-- Relasi: N Siswa → 1 Kelas (Many to One)
--         1 Siswa → N Absensi (One to Many)

CREATE TABLE siswas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    kelas_id BIGINT UNSIGNED NOT NULL COMMENT 'FK: Referensi ke kelas.id',
    nis VARCHAR(255) NOT NULL UNIQUE COMMENT 'Nomor Induk Siswa',
    nama_lengkap VARCHAR(255) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tanggal_lahir DATE NULL,
    alamat TEXT NULL,
    no_telp VARCHAR(255) NULL,
    nama_orang_tua VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Foreign Key Constraint
    CONSTRAINT fk_siswas_kelas_id 
        FOREIGN KEY (kelas_id) 
        REFERENCES kelas(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    
    -- Indexes untuk performa query
    INDEX idx_kelas_id (kelas_id),
    INDEX idx_nis (nis),
    INDEX idx_nama_lengkap (nama_lengkap)
);

-- ============================================================================
-- TABLE 4: ABSENSI (Data Kehadiran/Absensi)
-- ============================================================================
-- Menyimpan data kehadiran siswa
-- Relasi: N Absensi → 1 Siswa (Many to One)
--         N Absensi → 1 Kelas (Many to One)

CREATE TABLE absensi (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    siswa_id BIGINT UNSIGNED NOT NULL COMMENT 'FK: Referensi ke siswas.id',
    kelas_id BIGINT UNSIGNED NOT NULL COMMENT 'FK: Referensi ke kelas.id',
    tanggal_absen DATE NOT NULL,
    status ENUM('Hadir', 'Sakit', 'Izin', 'Alpa') NOT NULL DEFAULT 'Hadir',
    keterangan TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Foreign Key Constraints
    CONSTRAINT fk_absensi_siswa_id 
        FOREIGN KEY (siswa_id) 
        REFERENCES siswas(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    
    CONSTRAINT fk_absensi_kelas_id 
        FOREIGN KEY (kelas_id) 
        REFERENCES kelas(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    
    -- Unique Constraint: Mencegah duplikasi absensi dalam satu hari
    UNIQUE KEY uq_siswa_tanggal (siswa_id, tanggal_absen),
    
    -- Indexes untuk performa query
    INDEX idx_siswa_id (siswa_id),
    INDEX idx_kelas_id (kelas_id),
    INDEX idx_tanggal_absen (tanggal_absen),
    INDEX idx_status (status),
    INDEX idx_siswa_tanggal (siswa_id, tanggal_absen)
);

-- ============================================================================
-- RELASI RINGKAS
-- ============================================================================

/*
USERS (1) ──manages──→ (N) KELAS
   ↓
KELAS (1) ──contains──→ (N) SISWA
   ↓                      ↓
KELAS (1) ──tracks────→ (N) ABSENSI ←─records── (1) SISWA

Cardinalitas:
- Users to Kelas: 1:N (One user dapat mengelola banyak kelas)
- Kelas to Siswa: 1:N (Satu kelas dapat memiliki banyak siswa)
- Siswa to Absensi: 1:N (Satu siswa memiliki banyak record absensi)
- Kelas to Absensi: 1:N (Satu kelas memiliki banyak record absensi)
*/

-- ============================================================================
-- QUERY EXAMPLES & USE CASES
-- ============================================================================

-- 1. Mendapatkan semua siswa dalam kelas tertentu
-- SELECT s.* FROM siswas s WHERE s.kelas_id = 1;

-- 2. Mendapatkan absensi siswa dalam periode tertentu
-- SELECT a.* FROM absensi a
-- WHERE a.siswa_id = 1 
--   AND DATE(a.tanggal_absen) BETWEEN '2024-01-01' AND '2024-12-31';

-- 3. Statistik kehadiran per kelas
-- SELECT 
--   k.nama_kelas,
--   a.status,
--   COUNT(*) as jumlah
-- FROM kelas k
-- JOIN absensi a ON k.id = a.kelas_id
-- GROUP BY k.id, a.status;

-- 4. Total siswa per kelas
-- SELECT k.nama_kelas, COUNT(s.id) as total_siswa
-- FROM kelas k
-- LEFT JOIN siswas s ON k.id = s.kelas_id
-- GROUP BY k.id;

-- 5. Rekapitulasi kehadiran siswa per bulan
-- SELECT 
--   s.nama_lengkap,
--   COUNT(CASE WHEN a.status = 'Hadir' THEN 1 END) as hadir,
--   COUNT(CASE WHEN a.status = 'Sakit' THEN 1 END) as sakit,
--   COUNT(CASE WHEN a.status = 'Izin' THEN 1 END) as izin,
--   COUNT(CASE WHEN a.status = 'Alpa' THEN 1 END) as alpa
-- FROM absensi a
-- JOIN siswas s ON a.siswa_id = s.id
-- WHERE MONTH(a.tanggal_absen) = 12 AND YEAR(a.tanggal_absen) = 2024
-- GROUP BY s.id;

-- 6. Siswa dengan absensi terbanyak (indisipliner)
-- SELECT 
--   s.nama_lengkap,
--   COUNT(*) as total_alpa
-- FROM absensi a
-- JOIN siswas s ON a.siswa_id = s.id
-- WHERE a.status = 'Alpa'
-- GROUP BY s.id
-- ORDER BY total_alpa DESC
-- LIMIT 10;

-- 7. Siswa yang tidak pernah absen sama sekali
-- SELECT s.* FROM siswas s
-- WHERE s.id NOT IN (SELECT DISTINCT siswa_id FROM absensi)
-- ORDER BY s.kelas_id;

-- 8. Detail absensi dengan nama siswa dan kelas
-- SELECT 
--   s.nama_lengkap,
--   k.nama_kelas,
--   a.tanggal_absen,
--   a.status,
--   a.keterangan
-- FROM absensi a
-- JOIN siswas s ON a.siswa_id = s.id
-- JOIN kelas k ON a.kelas_id = k.id
-- ORDER BY a.tanggal_absen DESC, k.nama_kelas;

-- ============================================================================
-- CASCADE DELETE BEHAVIOR
-- ============================================================================

/*
Ketika Kelas dihapus:
  DELETE FROM kelas WHERE id = X
  → Otomatis hapus semua SISWA dengan kelas_id = X
  → Otomatis hapus semua ABSENSI dengan kelas_id = X (atau siswa_id dari siswa terkait)

Ketika Siswa dihapus:
  DELETE FROM siswas WHERE id = Y
  → Otomatis hapus semua ABSENSI dengan siswa_id = Y

Catatan: ON DELETE CASCADE sudah dikonfigurasi di Foreign Key Constraints
*/

-- ============================================================================
-- BUSINESS RULES
-- ============================================================================

/*
1. UNIQUE CONSTRAINTS (Data Integritas):
   - Users.email: Setiap user harus punya email unik
   - Kelas.nama_kelas: Setiap kelas harus punya nama unik
   - Siswa.nis: Setiap siswa harus punya NIS (Nomor Induk Siswa) unik
   - (Siswa.id, Absensi.tanggal_absen): Tidak boleh ada duplikasi absensi 
     untuk siswa yang sama dalam satu hari

2. FOREIGN KEY CONSTRAINTS (Referential Integrity):
   - Siswa.kelas_id → Kelas.id (Siswa harus terdaftar dalam kelas yang ada)
   - Absensi.siswa_id → Siswa.id (Absensi harus milik siswa yang ada)
   - Absensi.kelas_id → Kelas.id (Absensi harus dari kelas yang ada)

3. ENUM CONSTRAINTS (Domain Integrity):
   - Users.role: Hanya 'admin' atau 'guru'
   - Siswa.jenis_kelamin: Hanya 'Laki-laki' atau 'Perempuan'
   - Absensi.status: Hanya 'Hadir', 'Sakit', 'Izin', atau 'Alpa'

4. NOT NULL CONSTRAINTS (Mandatory Fields):
   - Setiap record harus memiliki informasi wajib (name, email, nis, dll)

5. DEFAULT VALUES:
   - Users.role: 'guru' (default role saat user baru ditambah)
   - Kelas.kapasitas: 30 (kapasitas default)
   - Absensi.status: 'Hadir' (status default)
*/

-- ============================================================================
-- DATA DICTIONARY
-- ============================================================================

/*
USERS:
  id: BIGINT UNSIGNED - Unique identifier
  name: VARCHAR(255) - Nama lengkap user
  email: VARCHAR(255) - Email address (unik)
  password: VARCHAR(255) - Password terenkripsi dengan bcrypt
  role: ENUM('admin', 'guru') - Peran user dalam sistem
  created_at: TIMESTAMP - Waktu pembuatan record
  updated_at: TIMESTAMP - Waktu update terakhir

KELAS:
  id: BIGINT UNSIGNED - Unique identifier
  nama_kelas: VARCHAR(255) - Nama kelas (misal: X-RPL-1)
  tingkat: VARCHAR(255) - Tingkat kelas (X, XI, XII)
  jurusan: VARCHAR(100) - Program keahlian (RPL, TKJ, APL, dll)
  kapasitas: INT - Jumlah maksimal siswa
  created_at: TIMESTAMP - Waktu pembuatan record
  updated_at: TIMESTAMP - Waktu update terakhir

SISWAS:
  id: BIGINT UNSIGNED - Unique identifier
  kelas_id: BIGINT UNSIGNED - Foreign key ke kelas
  nis: VARCHAR(255) - Nomor Induk Siswa (unik per sekolah)
  nama_lengkap: VARCHAR(255) - Nama lengkap siswa
  jenis_kelamin: ENUM - Laki-laki atau Perempuan
  tanggal_lahir: DATE - Tanggal lahir siswa
  alamat: TEXT - Alamat rumah
  no_telp: VARCHAR(255) - Nomor telepon siswa/orang tua
  nama_orang_tua: VARCHAR(255) - Nama ayah/ibu/wali
  created_at: TIMESTAMP - Waktu pembuatan record
  updated_at: TIMESTAMP - Waktu update terakhir

ABSENSI:
  id: BIGINT UNSIGNED - Unique identifier
  siswa_id: BIGINT UNSIGNED - Foreign key ke siswa
  kelas_id: BIGINT UNSIGNED - Foreign key ke kelas
  tanggal_absen: DATE - Tanggal ketidakhadiran
  status: ENUM - Status: Hadir/Sakit/Izin/Alpa
  keterangan: TEXT - Catatan tambahan (misal: alasan sakit)
  created_at: TIMESTAMP - Waktu pembuatan record
  updated_at: TIMESTAMP - Waktu update terakhir
*/

-- ============================================================================
