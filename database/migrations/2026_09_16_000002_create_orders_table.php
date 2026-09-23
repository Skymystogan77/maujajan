<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan proses pembuatan tabel orders untuk transaksi pesanan (Migration Up).
     */
    public function up(): void
    {
        // Membuat tabel 'orders' untuk mencatat transaksi pesanan dari pelanggan
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary Key ID Transaksi Pesanan
            $table->string('customer_name'); // Nama lengkap pelanggan pemesan
            $table->string('table_number'); // Nomor meja tempat duduk pelanggan
            $table->integer('total_price'); // Total tagihan pembayaran pesanan (Rupiah)
            $table->string('status')->default('Pending'); // Status pesanan (Default: Pending)
            $table->timestamps(); // Catatan waktu pesanan dibuat & di-update
        });
    }

    /**
     * Hapus tabel orders (Migration Down).
     */
    public function down(): void
    {
        Schema::dropIfExists('orders'); // Hapus tabel orders jika rollback
    }
};
