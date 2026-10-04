# 🚀 CodingKids - Sistem Pendaftaran Peserta (SD & SMP)

Aplikasi web full-stack modern berbasis **Laravel** untuk sistem pendaftaran peserta kursus/pelatihan pemrograman anak (**CodingKids**) dengan kategori peserta tingkat **SD (Sekolah Dasar)** dan **SMP (Sekolah Menengah Pertama)**.

---

## 🛠️ Stack Teknologi

- **Backend Framework**: Laravel 12 (PHP 8.3+)
- **Database**: MySQL (Eloquent ORM & DB Transactions)
- **Frontend Template**: Blade Template + Tailwind CSS v4 + Alpine.js + Chart.js
- **Exports**: PhpSpreadsheet (.xlsx) & Native CSV (UTF-8 BOM)
- **Authentication**: Laravel Session-based Authentication & Password Hashing (Bcrypt)

---

## 🌟 Fitur Utama

### 1. Halaman Publik (Ramah Anak & Orang Tua)
- **Landing Page (`/`)**: Hero section ceria, highlight keunggulan kurikulum, FAQ, dan kartu pilihan kategori **[ SD ]** & **[ SMP ]**.
- **Formulir Pendaftaran (`/daftar/{category}`)**:
  - Validasi ketat Laravel Form Request berbahasa Indonesia.
  - Kategori terkunci otomatis sesuai pilihan (`sd` / `smp`).
  - **Modal Konfirmasi Interaktif**: Review data pendaftaran sebelum final submit.
  - Pertahankan isian input (*old input*) jika terdapat error validasi.
- **Halaman Sukses (`/pendaftaran/berhasil/{registration_code}`)**:
  - Menampilkan nomor registrasi resmi format `CK-2026-XXXX`.
  - Ringkasan data pendaftaran.
  - Tombol Salin Kode, Cetak Bukti, dan Kembali ke Beranda.
- **Cetak Bukti Pendaftaran (`/pendaftaran/{registration_code}/cetak`)**:
  - Format slip resmi *print-friendly* (A4/kartu) bebas elemen navigasi web.

### 2. Halaman Administrator (`/admin`)
- **Autentikasi Admin (`/admin/login`)**:
  - Proteksi Middleware `auth` & CSRF Protection.
  - Default Admin: `admin@codingkids.id` | Kata Sandi: `admin123`.
- **Dashboard Admin (`/admin`)**:
  - 4 Kartu Statistik: Total Peserta, Peserta SD, Peserta SMP, Pendaftaran Hari Ini.
  - Grafik Visual: Proporsi Peserta SD vs SMP (Doughnut) & Tren Pendaftaran 7 Hari (Bar Chart).
  - Tabel Peserta Terbaru.
- **Data Peserta (`/admin/peserta`)**:
  - Tabel lengkap: No, Kode, Nama, Tgl Lahir, Kategori, Sekolah, Orang Tua, No HP, Tgl Daftar.
  - Pencarian fleksibel (Nama, Kode, Sekolah, No HP).
  - Filter Kategori (SD/SMP), Asal Sekolah, dan Tanggal Pendaftaran.
  - Sorting kolom dan Laravel Pagination.
- **Detail Peserta (`/admin/peserta/{id}`)**:
  - Kartu identitas anak, kartu data orang tua, dan timeline pendaftaran + tautan langsung WhatsApp.
- **Edit Peserta (`/admin/peserta/{id}/edit`)**:
  - Formulir pembaruan data dengan validasi server-side.
- **Hapus Peserta (DELETE)**:
  - Dialog konfirmasi interaktif & CSRF token.
- **Laporan & Ekspor (`/admin/laporan`)**:
  - Filter dinamis berdasarkan kategori, sekolah, dan rentang tanggal.
  - **Ekspor Excel (.xlsx)** via PhpSpreadsheet dengan header styling & auto column width.
  - **Ekspor CSV** dengan UTF-8 BOM untuk kompatibilitas Microsoft Excel.
  - **Cetak Laporan (`/admin/laporan/print`)**: Layout A4 landscape resmi lengkap dengan kop surat dan kolom tanda tangan penanggung jawab.

---

## 📋 Struktur Database (`registrations`)

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| `id` | BIGINT (PK) | Auto Increment |
| `registration_code` | VARCHAR(30) | Unique Index (Format `CK-YYYY-XXXX`) |
| `full_name` | VARCHAR(255) | Nama Lengkap Peserta |
| `birth_date` | DATE | Tanggal Lahir |
| `category` | ENUM('sd', 'smp') | Kategori Jenjang |
| `school` | VARCHAR(255) | Asal Sekolah |
| `parent_name` | VARCHAR(255) | Nama Orang Tua/Wali |
| `parent_phone` | VARCHAR(25) | Nomor HP / WhatsApp Indonesia |
| `address` | TEXT | Alamat Lengkap |
| `registered_at` | TIMESTAMP | Waktu Pendaftaran Masuk |
| `created_at` / `updated_at` | TIMESTAMP | Timestamps Laravel |

---

## 🚀 Panduan Instalasi & Menjalankan

### 1. Konfigurasi Database (.env)
Pastikan MySQL service telah berjalan di Laragon / XAMPP, lalu periksa konfigurasi di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=form_codingkids
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Jalankan Migrasi & Seeder
Buat database `form_codingkids` di MySQL (atau jalankan script berikut), lalu migrasikan:
```bash
php artisan migrate:fresh --seed
```
*Seeder akan membuat akun admin awal dan data dummy pendaftaran untuk pengujian.*

### 3. Build Aset Frontend
```bash
npm install
npm run build
```

### 4. Jalankan Server Lokal
```bash
php artisan serve
```
Buka browser pada: **`http://127.0.0.1:8000`** atau melalui Virtual Host Laragon: **`http://form_codingkids.test`**.

---

## 🔐 Akun Login Administrator
- **URL**: `http://127.0.0.1:8000/admin/login`
- **Email**: `admin@codingkids.id`
- **Password**: `admin123`

---

## 🧪 Menjalankan Pengujian Otomatis
```bash
php artisan test
```
Semua 16 Feature & Unit Tests (68 assertions) siap dijalankan dan terverifikasi **PASS**.
