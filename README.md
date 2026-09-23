# ?? MauJajan - Aplikasi Pemesanan Makanan Online (Laravel 11)

Aplikasi web pemesanan makanan & minuman online berbasis **Laravel 11**, dirancang untuk mempermudah transaksi pemesanan di restoran/kantin secara digital dari sisi pelanggan (Customer) hingga pengelolaan data & rekap pesanan di sisi Admin.

---

## ?? Fitur Utama Aplikasi

### ????? Sisi Customer (Pelanggan)
1. **Katalog Menu Digital (`/menu`)**: Menampilkan daftar menu makanan, minuman, dan cemilan secara real-time dari database.
2. **Filter Kategori (JavaScript)**: Memfilter tampilan menu berdasarkan kategori (Makanan, Minuman, Cemilan, Semua Menu) tanpa *reload* halaman.
3. **Form Pemesanan & Checkout**: Memilih kuantitas porsi makanan, menginputkan Nama Pemesan dan Nomor Meja.
4. **Modal Konfirmasi Pesanan**: Menampilkan pop-up ringkasan rincian menu dan total pembayaran sebelum pesanan dikirim.

### ??? Sisi Admin (Pengelola / Kasir)
1. **Autentikasi Terproteksi (`/login`)**: Login Admin menggunakan paket Laravel Breeze.
2. **Dashboard Rekap Pesanan (`/dashboard`)**: Menampilkan tabel daftar pesanan masuk dari pelanggan secara *real-time* lengkap dengan rincian item, nomor meja, total harga, dan status pesanan.
3. **Update Status Pesanan**: Mengubah status pesanan (*Pending*, *Diproses*, *Selesai*, *Batalkan Pesanan*) secara *live* dengan efek badge warna.
4. **CRUD Master Data Makanan (`/admin/foods`)**: Tambah makanan baru (dengan upload gambar), lihat daftar, edit data & gambar, serta hapus makanan.

---

## ?? Akun Login Admin

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@maujajan.com` | `password123` |
| **User/Customer** | `user@maujajan.com` | `password123` |

---

## ??? Spesifikasi Teknis & Struktur Database

### ??? Tabel Database (`SQLite`)
1. **`foods` (Master Makanan)**
   - `id`: Primary Key (Auto-Increment)
   - `name`: Nama Makanan/Minuman (`string`)
   - `category`: Kategori (`enum`: `'Makanan'`, `'Minuman'`, `'Cemilan'`)
   - `price`: Harga Produk dalam Rupiah (`integer`)
   - `description`: Deskripsi Produk (`text`)
   - `image`: Path Gambar Produk (`string`, nullable)
   - `timestamps`: `created_at` & `updated_at`

2. **`orders` (Transaksi Pesanan)**
   - `id`: Primary Key (Auto-Increment)
   - `customer_name`: Nama Pemesan (`string`)
   - `table_number`: Nomor Meja (`string`)
   - `total_price`: Total Tagihan Pembayaran (`integer`)
   - `status`: Status Pesanan (`string`, default: `'Pending'`)
   - `timestamps`: `created_at` & `updated_at`

3. **`order_details` (Detail Transaksi / Relasi)**
   - `id`: Primary Key (Auto-Increment)
   - `order_id`: Foreign Key ke `orders.id` (`cascade`)
   - `food_id`: Foreign Key ke `foods.id` (`cascade`)
   - `quantity`: Jumlah Porsi Dipesan (`integer`)
   - `subtotal`: Subtotal Harga Item (`integer`)
   - `timestamps`: `created_at` & `updated_at`

---

## ?? Petunjuk Instalasi & Menjalankan Proyek

1. **Clone / Download Repositori**:
   ```bash
   git clone https://github.com/Skymystogan77/maujajan.git
   cd maujajan
   ```

2. **Install Dependensi Composer & NPM**:
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi File `.env`**:
   Pastikan konfigurasi `.env` menggunakan database SQLite:
   ```env
   DB_CONNECTION=sqlite
   ```

4. **Jalankan Migration & Seeder Database**:
   ```bash
   php artisan migrate:fresh --seed
   php artisan storage:link
   ```

5. **Jalankan Server Aplikasi**:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser di: `http://127.0.0.1:8000`

---

## ?? Penjelasan File & Alur Baris Kode (Line-by-Line Guide)

- **`routes/web.php`**: Berisi seluruh pendaftaran rute aplikasi (Rute Publik Welcome `/`, Katalog `/menu`, Checkout `/checkout`, Rute Terproteksi `/dashboard`, `/admin/foods`, dan `/admin/orders`).
- **`app/Http/Controllers/FoodController.php`**: Menangani logika bisnis CRUD master data makanan (index, create, store, edit, update, destroy) termasuk manajemen unggah gambar ke storage public.
- **`app/Http/Controllers/OrderController.php`**: Menangani logika pembuatan pesanan pelanggan dengan fitur **Database Transaction (`DB::beginTransaction()`)** untuk menjaga konsistensi data multi-tabel antara `orders` dan `order_details`, serta update status pesanan admin.
- **`resources/views/customer/index.blade.php`**: View katalog pelanggan menggunakan Tailwind CSS CDN, filter JavaScript, form checkout, dan modal konfirmasi sebelum submit.
- **`resources/views/dashboard.blade.php`**: View dashboard admin untuk melihat tabel pesanan masuk, rincian item, dan dropdown update status pesanan.

---
© 2026 **MauJajan App** - Developed for Laravel Project Requirement.
