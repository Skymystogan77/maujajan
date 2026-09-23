<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes - Aplikasi Pemesanan Makanan MauJajan
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama publik: Menampilkan template bawaan Laravel Breeze Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Katalog Menu & Pemesanan Pelanggan (Customer Area)
Route::get('/menu', [OrderController::class, 'index'])->name('customer.index'); // Menampilkan katalog makanan
Route::post('/checkout', [OrderController::class, 'store'])->name('customer.checkout'); // Memproses pesanan/checkout

// 3. Halaman Dashboard Admin (Wajib Login & Email Terverifikasi)
Route::get('/dashboard', [OrderController::class, 'adminDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 4. Grup Rute Admin (Terproteksi Middleware Auth)
Route::middleware('auth')->group(function () {
    // Pengelolaan Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Alias Rute Dashboard Admin & Rekap Pesanan
    Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/orders', [OrderController::class, 'adminDashboard'])->name('admin.orders.index');
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    
    // CRUD Master Data Makanan (Resource Controller)
    Route::resource('/admin/foods', FoodController::class);
});

// Memuat rute autentikasi bawaan Laravel Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';
