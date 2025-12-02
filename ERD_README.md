# ERD - Sistem Informasi Absensi Kelas

Dokumentasi Entity Relationship Diagram (ERD) untuk Sistem Informasi Absensi Kelas.

## 📋 File Dokumentasi

Tersedia 4 format dokumentasi ERD yang berbeda:

### 1. **ERD.md** - Format PlantUML & Markdown
- Deskripsi tabel lengkap dengan kolom dan tipe data
- Penjelasan relasi antar tabel
- Contoh query SQL
- Notes dan best practices

**Cara membuka:**
- Buka dengan text editor atau Markdown viewer
- Untuk visualisasi PlantUML: Salin code PlantUML ke [planttext.com](http://www.plantuml.com/plantuml/uml/)

### 2. **ERD_MERMAID.md** - Format Mermaid Diagram (Recommended!)
- Diagram interaktif yang bisa dilihat langsung di GitHub
- Penjelasan struktur setiap tabel
- Alur data dan cascade delete behavior
- Query statistik & laporan

**Cara membuka:**
- Buka dengan GitHub atau tools yang support Mermaid
- Atau paste di [Mermaid Live Editor](https://mermaid.live/)
- Diagram akan otomatis render

### 3. **ERD_VISUAL.txt** - Format ASCII Art & Teks
- Visualisasi ERD dalam format teks ASCII
- Tabel relasi ringkas
- Business rules & constraints
- Contoh operasi & scenario

**Cara membuka:**
- Buka dengan text editor biasa
- Format ASCII memudahkan dibaca tanpa tools tambahan

### 4. **ERD_SCHEMA.sql** - Dokumentasi SQL Lengkap
- DDL (Data Definition Language) untuk membuat tabel
- Foreign key & constraints yang detail
- Comment lengkap di setiap kolom
- Contoh query use case
- Data dictionary

**Cara membuka:**
- Buka dengan SQL IDE atau text editor
- Bisa langsung dijalankan untuk membuat database

---

## 🎯 Quick Reference

### 4 Tabel Utama

| Tabel | Fungsi | Relasi |
|-------|--------|--------|
| **USERS** | Pengguna sistem (admin/guru) | Manages N Kelas |
| **KELAS** | Data kelas/rombongan belajar | Contains N Siswa, Tracks N Absensi |
| **SISWA** | Data siswa | Belongs to 1 Kelas, Has N Absensi |
| **ABSENSI** | Data kehadiran/absensi | Belongs to 1 Siswa & 1 Kelas |

### Relasi Antar Tabel

```
Users (1) ──→ (N) Kelas ──→ (N) Siswa ──→ (N) Absensi
                  ↓
                  └─→ (N) Absensi
```

### Status Enum
- **Absensi.status:** Hadir | Sakit | Izin | Alpa
- **Users.role:** admin | guru
- **Siswa.jenis_kelamin:** Laki-laki | Perempuan

---

## 📊 Struktur Singkat

### USERS
```
id (PK), name, email (UNIQUE), password, role (admin/guru), timestamps
```

### KELAS
```
id (PK), nama_kelas (UNIQUE), tingkat (X/XI/XII), jurusan, kapasitas, timestamps
```

### SISWA
```
id (PK), kelas_id (FK→KELAS), nis (UNIQUE), nama_lengkap, jenis_kelamin, 
tanggal_lahir, alamat, no_telp, nama_orang_tua, timestamps
→ Cascade Delete: Jika Kelas dihapus, Siswa terhapus
```

### ABSENSI
```
id (PK), siswa_id (FK→SISWA), kelas_id (FK→KELAS), tanggal_absen, status, keterangan, timestamps
→ Unique Constraint: (siswa_id, tanggal_absen)
→ Cascade Delete: Jika Siswa dihapus, Absensi terhapus
```

---

## 🔍 Cara Memilih Format

| Situasi | Format Rekomendasi |
|---------|-------------------|
| Mau lihat diagram yang bagus | **ERD_MERMAID.md** |
| Mau dokumentasi lengkap | **ERD.md** |
| Mau visualisasi tanpa tools | **ERD_VISUAL.txt** |
| Mau SQL actual & schema | **ERD_SCHEMA.sql** |
| Semua yang di atas | **Baca semua file!** |

---

## 💡 Contoh Penggunaan

### Query 1: Total siswa per kelas
```sql
SELECT k.nama_kelas, COUNT(s.id) as total_siswa
FROM kelas k
LEFT JOIN siswas s ON k.id = s.kelas_id
GROUP BY k.id;
```

### Query 2: Rekapitulasi kehadiran bulan ini
```sql
SELECT 
  s.nama_lengkap,
  COUNT(CASE WHEN a.status = 'Hadir' THEN 1 END) as hadir,
  COUNT(CASE WHEN a.status = 'Alpa' THEN 1 END) as alpa
FROM absensi a
JOIN siswas s ON a.siswa_id = s.id
WHERE MONTH(a.tanggal_absen) = MONTH(NOW())
GROUP BY s.id;
```

### Query 3: Siswa dengan absensi terbanyak
```sql
SELECT s.nama_lengkap, COUNT(*) as total_alpa
FROM absensi a
JOIN siswas s ON a.siswa_id = s.id
WHERE a.status = 'Alpa'
GROUP BY s.id
ORDER BY total_alpa DESC LIMIT 10;
```

---

## ⚠️ Business Rules

1. **Cascade Delete:**
   - Kelas dihapus → Semua Siswa & Absensi terhapus
   - Siswa dihapus → Semua Absensi terhapus

2. **Unique Constraints:**
   - Email user harus unik
   - Nama kelas harus unik
   - NIS siswa harus unik
   - Tidak boleh duplikasi absensi dalam 1 hari

3. **Enum Values:**
   - Role: admin | guru
   - Status Absensi: Hadir | Sakit | Izin | Alpa
   - Jenis Kelamin: Laki-laki | Perempuan

---

## 📝 Catatan

- **Soft Delete belum diimplementasikan** - Data yang dihapus hilang permanen
- **Audit trail belum ada** - Pertimbangkan menambah deleted_by & deleted_at kolom
- **Role-based access belum di ERD** - Implementasi di aplikasi

---

## 🔗 Visualisasi Online

Untuk visualisasi diagram secara online:

1. **Mermaid:** Paste content dari `ERD_MERMAID.md` ke https://mermaid.live/
2. **PlantUML:** Paste content dari `ERD.md` ke http://www.plantuml.com/plantuml/uml/

---

## 📞 Pertanyaan?

Untuk informasi lebih lengkap tentang tabel spesifik, lihat file dokumentasi masing-masing:
- Detail kolom & tipe data → **ERD_SCHEMA.sql**
- Cardinalitas & relasi → **ERD_MERMAID.md**
- Contoh operasi & scenario → **ERD_VISUAL.txt**
- Query examples → **ERD.md**

