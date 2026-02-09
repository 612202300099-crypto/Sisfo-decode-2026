# 🎓 Sisfo Decode Bootcamp 2026 — Modern Academic Information System

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com)
[![Railway](https://img.shields.io/badge/Live_Demo-Railway-0B0D0E?style=for-the-badge&logo=railway)](https://sisfo-decode-2026-production.up.railway.app/)

**Sisfo Decode Bootcamp 2026** adalah proyek implementasi sistem informasi akademik yang dikembangkan dalam rangka mempersiapkan mahasiswa Sistem Informasi Kampus Kota Kediri menghadapi semester genap. Proyek ini memfokuskan pada penguasaan CRUD (*Create, Read, Update, Delete*), manajemen basis data, dan perancangan antarmuka pengguna (UI/UX) yang modern dan fungsional.

🌐 **Link Demo Live**: [https://sisfo-decode-2026-production.up.railway.app/](https://sisfo-decode-2026-production.up.railway.app/)

---

## 🌟 Tentang Kegiatan
Proyek ini merupakan bagian dari **Sisfo Decode Bootcamp**, sebuah inisiatif dari Biro Sistem Informasi x Program Studi Sistem Informasi Udinus Kediri untuk membekali mahasiswa angkatan 2023, 2024, dan 2025 dengan keterampilan praktis dalam pengembangan web menggunakan Laravel.

- **Materi**: CRUD Kompleks & UI/UX Premium
- **Lokasi**: Lab. Komputer Udinus Kediri
- **Tujuan**: Mempersiapkan bekal teknis untuk mata kuliah di semester mendatang.

---

## ✨ Fitur Utama Sistem
Aplikasi ini dirancang bukan hanya sebagai CRUD biasa, melainkan sebuah sistem yang siap untuk skala produksi:

### 🌗 Adaptive Theme (Dark/Light Mode)
Transisi tema yang halus antara mode terang dan gelap untuk kenyamanan mata pengguna di berbagai kondisi pencahayaan.

### 🔍 Smart Global Search
Fitur pencarian di navbar yang memudahkan admin menemukan data Mahasiswa atau Mata Kuliah secara instan dengan hasil yang akurat.

### 📊 Dashboard Dinamis
Visualisasi data statistik mahasiswa dan program studi menggunakan **ApexCharts**, membantu pengambilan keputusan akademik secara lebih cepat.

### ♻️ Trash System (Safety First)
Perlindungan data menggunakan fitur *Soft Delete*. Data yang dihapus tidak langsung hilang permanen, melainkan aman disimpan di menu "Sampah" untuk bisa dipulihkan kembali jika diperlukan.

### 📥 Data Import & Export
Mendukung pengelolaan data massal melalui fitur ekspor ke CSV dan impor data langsung menggunakan template yang telah disediakan.

---

## 🖼️ Galeri Antarmuka

| Dashboard Utama (Mode Terang) | Dashboard Utama (Mode Gelap) |
| :---: | :---: |
| ![Dashboard Light](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/light_dashboard.jpg) | ![Dashboard Dark](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/dark_dashboard.jpg) |
| *Statistik akademik dengan tampilan bersih* | *Opsi mode gelap yang elegan dan profesional* |

| Daftar Mahasiswa | Fitur Tempat Sampah |
| :---: | :---: |
| ![Student Index](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/student_index.jpg) | ![Trash System](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/trash_system.jpg) |
| *Tabel data yang rapi dan fungsional* | *Keamanan data dengan sistem restorasi* |

| Program Studi | Daftar Mata Kuliah |
| :---: | :---: |
| ![Prodi Index](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/prodi_index.jpg) | ![Subject Index](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/subject_index.jpg) |
| *Manajemen kurikulum prodi* | *Daftar mata kuliah akademik* |

| Form Input Premium | Form Edit Data |
| :---: | :---: |
| ![Create Form](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/create_form.jpg) | ![Edit Form](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/edit_form.jpg) |
| *UI yang memanjakan mata saat manajemen data* | *Kemudahan pembaruan informasi* |

---

## 🛠️ Stack Teknologi
- **Core**: Laravel 11 (PHP 8.2+)
- **UI/UX**: Bootstrap 5.3 & Vanilla JavaScript
- **Charting**: ApexCharts JS
- **Deployment**: Railway.app

---

## 🚀 Cara Menjalankan Project
Bagi rekan-rekan mahasiswa yang ingin mencoba menjalankan proyek ini di lokal:

1. **Clone & Setup**:
   ```bash
   git clone https://github.com/612202300099-crypto/Sisfo-decode-2026.git
   cd Sisfo-decode-2026
   composer install
   npm install
   ```
2. **Environment**:
   Sesuaikan database di file `.env`, lalu jalankan:
   ```bash
   php artisan key:generate
   php artisan migrate
   ```
3. **Run**:
   ```bash
   php artisan serve
   ```

---

## 📝 Penutup
Proyek ini diharapkan dapat menjadi tolak ukur pemahaman materi bootcamp bagi mahasiswa Sistem Informasi Udinus Kediri. Mari kita terus belajar dan berinovasi!

**Dibuat dengan Hati yang Tulus oleh Mochammad Rizky Juliansyah - F12202300099 - Sistem Informasi Udinus Kediri.**
