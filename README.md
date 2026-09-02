# 📚 Sistem Informasi Peminjaman Buku Perpustakaan Digital (Laravel)

Aplikasi Web Sistem Informasi Perpustakaan Digital berbasis **Laravel** dan **Blade UI** untuk mengelola katalog buku, pendaftaran anggota, transaksi peminjaman, serta pengembalian buku secara otomatis dan mandiri. Proyek ini disusun untuk Pembahasan **Paket 4 UKK TH 2026**.

[![Laravel Version](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

---

## ✨ Fitur Utama

### 👨‍💼 Panel Administrator
- 📊 **Dashboard Admin**: Ringkasan sistem dan akses cepat navigasi modul.
- 📚 **CRUD Data Buku**: Pengelolaan data buku perpustakaan (Kode Buku Unique, Judul, Pengarang, Penerbit, Stok).
- 👥 **CRUD Data Anggota (User)**: Pengelolaan akun siswa dan admin (Tambah, Edit, Hapus dengan proteksi akun aktif, Hashing Password).
- 🔄 **CRUD Transaksi Peminjaman**: Pencatatan transaksi peminjaman oleh admin dengan pembaruan stok otomatis (*auto-decrement* & *auto-increment* saat dikembalikan/dihapus).

### 👨‍🎓 Panel Siswa (User / Member)
- 📖 **Daftar Katalog Buku Tersedia**: Menampilkan buku yang memiliki stok aktif (`stok > 0`).
- ⚡ **Peminjaman Mandiri**: Meminjam buku langsung dari katalog dengan kalkulasi otomatis tanggal pinjam & batas pengembalian (+7 hari).
- 📜 **Riwayat Peminjaman Saya**: Memantau daftar buku yang sedang dipinjam beserta statusnya (`Dipinjam` / `Dikembalikan`).
- ↩️ **Pengembalian Mandiri**: Siswa dapat mengembalikan buku secara mandiri dari dashboard, dan stok buku otomatis bertambah kembali.

---

## 🛠️ Teknologi & Stack

- **Framework Backend**: Laravel 11.x (PHP 8.2+)
- **Frontend / Templating**: Blade Engine, Alpine.js, Tailwind CSS (Laravel Breeze)
- **Database**: MySQL / MariaDB
- **ORM**: Eloquent ORM (Relasi `User`, `Buku`, dan `Peminjaman`)

---

## 💻 Akun Pengujian Default (Seeder)

Setelah menjalankan seeder database (`php artisan db:seed`), gunakan kredensial berikut untuk menguji sistem:

| Role | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@perpus.com` | `password123` | Full Access (CRUD Buku, User, & Peminjaman) |
| **Siswa / User** | `siswa@perpus.com` | `password123` | Katalog & Peminjaman Mandiri |

---

## 🚀 Langkah Instalasi Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan repositori ini di lingkungan lokal Anda:

### 1. Clone Repositori
```bash
git clone https://github.com/Skymystogan77/peminjamanbuku-laravel.git
cd peminjamanbuku-laravel
```

### 2. Install Dependensi PHP & NPM
```bash
composer install
npm install
```

### 3. Konfigurasi File Environment `.env`
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Buka file `.env` dan atur konfigurasi database MySQL Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_perpus_digital
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key
```bash
php artisan key:generate
```

### 5. Migrasi & Seeder Database
Jalankan migrasi tabel beserta data awal admin & contoh buku:
```bash
php artisan migrate --seed
```

### 6. Jalankan Server Lokal
Jalankan server aplikasi Laravel:
```bash
php artisan serve
```

Akses aplikasi di browser melalui alamat: `http://127.0.0.1:8000`

---

## 📌 Alur Penggunaan Sistem

1. **Login sebagai Admin**: Buka `/login` dengan akun `admin@perpus.com` $\rightarrow$ Akses `/admin/dashboard` untuk mengelola data buku, user/siswa, dan transaksi peminjaman.
2. **Login sebagai Siswa**: Buka `/login` dengan akun `siswa@perpus.com` $\rightarrow$ Akses `/dashboard` untuk melihat katalog buku tersedia, klik **Pinjam**, lalu lakukan **Pengembalian Mandiri** dari tabel riwayat.

---

## 👤 Penulis & Pengembang

* **GitHub**: [@Skymystogan77](https://github.com/Skymystogan77)
* **Proyek**: UKK Paket 4 TH 2026 - Aplikasi Peminjaman Perpustakaan Digital
