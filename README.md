# 🎓 Sisfo Decode 2026 — Modern Academic Information System

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com)
[![Railway](https://img.shields.io/badge/Deployed_on-Railway-0B0D0E?style=for-the-badge&logo=railway)](https://railway.app)

**Sisfo Decode 2026** adalah platform manajemen akademik modern yang dirancang untuk memberikan pengalaman pengelolaan data mahasiswa, program studi, dan mata kuliah yang efisien, aman, dan memanjakan mata. Dibangun dengan fokus pada estetika dan kemudahan penggunaan (UX), sistem ini menggabungkan kekuatan Laravel dengan desain UI premium.

---

## ✨ Fitur Unggulan

### 🌗 Premium Adaptive Theme
Sistem ini mendukung **Dark Mode** dan **Light Mode** secara cerdas dengan *Semantic Color Tokens*. Tidak hanya sekadar merubah warna, tapi memberikan kenyamanan visual (eye-care) baik di siang maupun malam hari.

### 🔍 Global Search Engine
Temukan data mahasiswa atau mata kuliah secepat kilat melalui fitur pencarian global di navbar. Dilengkapi dengan saran instan (*instant suggestions*) yang memproses data secara *real-time*.

### 📊 Interactive Dashboard
Pantau statistik akademik Anda melalui dashboard yang dinamis. Dilengkapi dengan grafik interaktif dari **ApexCharts** yang secara otomatis menyesuaikan warna dengan tema yang Anda pilih.

### ♻️ Safe Data Management (Trash System)
Jangan takut kehilangan data! Kami mengimplementasikan sistem **Soft Delete**. Data yang dihapus akan masuk ke **Tempat Sampah** (Trash) terlebih dahulu, memungkinkan Anda untuk memulihkan (*restore*) atau menghapus permanen nantinya.

### 📥 Import & Export Tools
Kelola data massal dengan mudah. Anda dapat mengekspor data ke format CSV atau melakukan impor data menggunakan template resmi yang disediakan oleh sistem.

---

## 🖼️ Tampilan Aplikasi

| Dashboard (Light Mode) | Dashboard (Dark Mode) |
| :---: | :---: |
| ![Dashboard Light](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/light_dashboard.jpg) | ![Dashboard Dark](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/dark_dashboard.jpg) |
| *Ringkasan statistik akademik yang cerah* | *Visualisasi data yang elegan dan premium* |

| Menu Mahasiswa | Fitur Tempat Sampah |
| :---: | :---: |
| ![Student Index](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/student_index.jpg) | ![Trash System](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/trash_system.jpg) |
| *Pengelolaan profil mahasiswa yang rapi* | *Keamanan data dengan sistem restorasi* |

| Menu Program Studi | Menu Mata Kuliah |
| :---: | :---: |
| ![Prodi Index](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/prodi_index.jpg) | ![Subject Index](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/subject_index.jpg) |
| *Manajemen kurikulum & program studi* | *Daftar mata kuliah pendukung akademik* |

| Form Tambah Data (Premium UI) | Form Edit Data |
| :---: | :---: |
| ![Create Form](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/create_form.jpg) | ![Edit Form](https://raw.githubusercontent.com/612202300099-crypto/Sisfo-decode-2026/main/public/assets/img/screenshots/edit_form.jpg) |
| *Antarmuka penginputan yang bersih & modern* | *Kemudahan pembaruan data secara realtime* |

*(Note: Silakan unggah foto screenshot ke folder `public/assets/img/screenshots/` dengan nama file di atas agar muncul di GitHub)*

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: [Laravel 11](https://laravel.com) (PHP 8.2+)
- **Frontend**: [Bootstrap 5.3](https://getbootstrap.com), Vanilla JS
- **Visualisasi**: [ApexCharts](https://apexcharts.com)
- **Database**: MySQL / PostgreSQL
- **Deployment**: [Railway](https://railway.app)

---

## 🚀 Cara Menjalankan Project

### 1. Persiapan
Clone repository ini dan masuk ke direktori project:
```bash
git clone https://github.com/612202300099-crypto/Sisfo-decode-2026.git
cd Sisfo-decode-2026
```

### 2. Instalasi
Instal dependensi PHP dan Node.js:
```bash
composer install
npm install
```

### 3. Konfigurasi
Copy file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
Jalankan migrasi untuk membuat tabel dan struktur yang diperlukan:
```bash
php artisan migrate
```

### 5. Jalankan Aplikasi
Jalankan server lokal:
```bash
php artisan serve
```
Akses aplikasi melalui browser di `http://localhost:8000`.

---

## 🤝 Berkontribusi
Project ini dikembangkan untuk kebutuhan manajemen akademik yang lebih baik. Jika Anda menemukan bug atau memiliki ide fitur baru, silakan buka **Issue** atau kirimkan **Pull Request**.

---

## 📝 Lisensi
Didistribusikan di bawah lisensi MIT. Lihat `LICENSE` untuk informasi lebih lanjut.

---

**Dibuat dengan ❤️ untuk Masa Depan Akademik Digital.**
