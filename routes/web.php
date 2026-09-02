<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\KatalogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard / Katalog Buku untuk Siswa (User)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [KatalogController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/pinjam', [KatalogController::class, 'store'])->name('user.pinjam');
    Route::patch('/dashboard/kembali/{peminjaman}', [KatalogController::class, 'kembali'])->name('user.kembali');
});

// Dashboard Admin (Membutuhkan middleware kustom atau pengecekan role)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        // Pastikan hanya admin yang bisa akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Route CRUD Buku
    Route::resource('/admin/buku', BukuController::class, ['as' => 'admin']);
    // Route CRUD User (Anggota)
    Route::resource('/admin/user', UserController::class, ['as' => 'admin']);
    // Route CRUD Peminjaman
    Route::resource('/admin/peminjaman', PeminjamanController::class, ['as' => 'admin']);
    Route::patch('/admin/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.kembali');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
