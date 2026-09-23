<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan proses pembuatan struktur tabel database (Migration Up).
     */
    public function up(): void
    {
        // Membuat tabel 'foods' untuk menyimpan master data makanan
        Schema::create('foods', function (Blueprint $table) {
            $table->id(); // Primary Key (ID Otomatis Auto-Increment)
            $table->string('name'); // Nama makanan/minuman (Tipe: String/Varchar)
            $table->enum('category', ['Makanan', 'Minuman', 'Cemilan']); // Kategori produk (Tipe: ENUM)
            $table->integer('price'); // Harga produk dalam Rupiah (Tipe: Integer)
            $table->text('description'); // Deskripsi lengkap produk (Tipe: Text)
            $table->string('image')->nullable(); // Path/lokasi gambar makanan (Boleh kosong / NULL)
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Batalkan pembuatan tabel (Migration Down / Rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('foods'); // Hapus tabel foods jika rollback
    }
};
