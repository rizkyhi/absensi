# Entity Relationship Diagram (ERD)

## Struktur Database Sistem Absensi Kelas

### Diagram Teks (PlantUML)

Salin kode di bawah ke [planttext.com](http://www.plantuml.com/plantuml/uml/) atau tools PlantUML lainnya:

```
@startuml AbsensiKelas
!define TABLENAME(name) class name << (T,#FFAAAA) >>
!define PRIMARY_KEY(x) <b>PK: x</b>
!define FOREIGN_KEY(x) <b>FK: x</b>

TABLENAME(Users) {
  PRIMARY_KEY(id): bigint
  name: varchar(255)
  email: varchar(255) [UNIQUE]
  password: varchar(255)
  role: enum(admin, guru)
  email_verified_at: timestamp [NULL]
  remember_token: varchar(100) [NULL]
  created_at: timestamp
  updated_at: timestamp
}

TABLENAME(Kelas) {
  PRIMARY_KEY(id): bigint
  nama_kelas: varchar(255) [UNIQUE]
  tingkat: varchar(255)
  jurusan: varchar(100) [NULL]
  kapasitas: integer [DEFAULT: 30]
  created_at: timestamp
  updated_at: timestamp
}

TABLENAME(Siswa) {
  PRIMARY_KEY(id): bigint
  FOREIGN_KEY(kelas_id): bigint
  nis: varchar(255) [UNIQUE]
  nama_lengkap: varchar(255)
  jenis_kelamin: enum(Laki-laki, Perempuan)
  tanggal_lahir: date [NULL]
  alamat: text [NULL]
  no_telp: varchar(255) [NULL]
  nama_orang_tua: varchar(255) [NULL]
  created_at: timestamp
  updated_at: timestamp
}

TABLENAME(Absensi) {
  PRIMARY_KEY(id): bigint
  FOREIGN_KEY(siswa_id): bigint
  FOREIGN_KEY(kelas_id): bigint
  tanggal_absen: date
  status: enum(Hadir, Sakit, Izin, Alpa) [DEFAULT: Hadir]
  keterangan: text [NULL]
  created_at: timestamp
  updated_at: timestamp
  --
  UNIQUE: (siswa_id, tanggal_absen)
}

Users ||--o{ Kelas: manages
Kelas ||--o{ Siswa: contains
Siswa ||--o{ Absensi: records
Kelas ||--o{ Absensi: tracks

@enduml
```

---

## Deskripsi Tabel

### 1. **Users** (Pengguna Sistem)
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint | Primary Key |
| name | varchar(255) | Nama pengguna |
| email | varchar(255) | Email (unik) |
| password | varchar(255) | Password terenkripsi |
| role | enum | Admin atau Guru |
| email_verified_at | timestamp | Verifikasi email |
| remember_token | varchar(100) | Token remember me |
| created_at | timestamp | Dibuat pada |
| updated_at | timestamp | Diperbarui pada |

**Relasi:** Satu User dapat mengelola banyak Kelas (jika admin)

---

### 2. **Kelas** (Kelas/Rombongan Belajar)
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint | Primary Key |
| nama_kelas | varchar(255) | Nama kelas (unik) |
| tingkat | varchar(255) | X, XI, XII |
| jurusan | varchar(100) | RPL, TKJ, dll |
| kapasitas | integer | Kapasitas siswa (default: 30) |
| created_at | timestamp | Dibuat pada |
| updated_at | timestamp | Diperbarui pada |

**Relasi:** 
- Satu Kelas memiliki banyak Siswa (1:N)
- Satu Kelas memiliki banyak Absensi (1:N)

---

### 3. **Siswa** (Data Siswa)
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint | Primary Key |
| kelas_id | bigint | Foreign Key → Kelas |
| nis | varchar(255) | Nomor Induk Siswa (unik) |
| nama_lengkap | varchar(255) | Nama lengkap siswa |
| jenis_kelamin | enum | Laki-laki / Perempuan |
| tanggal_lahir | date | Tanggal lahir (nullable) |
| alamat | text | Alamat rumah |
| no_telp | varchar(255) | Nomor telepon |
| nama_orang_tua | varchar(255) | Nama orang tua |
| created_at | timestamp | Dibuat pada |
| updated_at | timestamp | Diperbarui pada |

**Relasi:**
- Banyak Siswa (N) bergabung dalam satu Kelas (1)
- Satu Siswa memiliki banyak Absensi (1:N)

**Constraint:** Cascade delete - jika Kelas dihapus, semua Siswa dalam kelas tersebut juga terhapus

---

### 4. **Absensi** (Data Kehadiran)
| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | bigint | Primary Key |
| siswa_id | bigint | Foreign Key → Siswa |
| kelas_id | bigint | Foreign Key → Kelas |
| tanggal_absen | date | Tanggal absensi |
| status | enum | Hadir/Sakit/Izin/Alpa |
| keterangan | text | Catatan tambahan |
| created_at | timestamp | Dibuat pada |
| updated_at | timestamp | Diperbarui pada |

**Relasi:**
- Banyak Absensi (N) milik satu Siswa (1)
- Banyak Absensi (N) dimiliki satu Kelas (1)

**Constraint:** 
- Cascade delete - jika Siswa dihapus, absensinya juga terhapus
- Unique constraint pada (siswa_id, tanggal_absen) - mencegah duplikasi

---

## Relasi Antar Tabel

```
┌─────────┐
│  Users  │
│ (Admin) │
└────┬────┘
     │
     │ manages
     ↓
┌──────────┐         ┌─────────┐
│  Kelas   │────────→│ Siswa   │
│ (1:N)    │ contains│ (N:1)   │
└──────────┘         └────┬────┘
     ↑                    │
     │                    │ records
     │ tracks             ↓
     │              ┌──────────┐
     └──────────────│ Absensi  │
          (1:N)     │ (N:1)    │
                    └──────────┘
```

---

## Cardinalitas

| Relasi | Tipe | Deskripsi |
|--------|------|-----------|
| Users → Kelas | 1:N | Satu user (admin/guru) mengelola banyak kelas |
| Kelas → Siswa | 1:N | Satu kelas berisi banyak siswa |
| Siswa → Absensi | 1:N | Satu siswa memiliki banyak record absensi |
| Kelas → Absensi | 1:N | Satu kelas memiliki banyak record absensi |

---

## Cascade Delete Policy

### Kelas dihapus → Terjadi:
1. Semua Siswa di kelas tersebut terhapus
2. Semua Absensi siswa di kelas tersebut terhapus

### Siswa dihapus → Terjadi:
1. Semua Absensi siswa tersebut terhapus

---

## Contoh Query Relasi

### Mendapatkan semua siswa di kelas tertentu
```sql
SELECT s.* FROM siswas s
WHERE s.kelas_id = 1;
```

### Mendapatkan absensi siswa dalam periode
```sql
SELECT a.* FROM absensi a
WHERE a.siswa_id = 5 
  AND DATE(a.tanggal_absen) BETWEEN '2024-01-01' AND '2024-12-31';
```

### Statistik kehadiran per kelas
```sql
SELECT 
  k.nama_kelas,
  a.status,
  COUNT(*) as jumlah
FROM kelas k
JOIN absensi a ON k.id = a.kelas_id
GROUP BY k.id, a.status;
```

### Cek siswa yang tidak pernah absen
```sql
SELECT s.* FROM siswas s
WHERE s.id NOT IN (
  SELECT DISTINCT siswa_id FROM absensi
);
```

---

## Notes

- **Soft Delete tidak digunakan** - Data yang dihapus akan hilang permanen dengan cascade delete
- **Audit Trail belum ada** - Pertimbangkan menambah `deleted_by` dan `deleted_at` jika diperlukan history
- **Status Absensi terbatas** pada: Hadir, Sakit, Izin, Alpa
- **Unique constraint pada siswa_id + tanggal_absen** - Mencegah duplikasi absensi dalam satu hari

