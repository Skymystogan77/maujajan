<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel relasi detail pesanan (Migration Up).
     */
    public function up(): void
    {
        // Membuat tabel 'order_details' (relasi n:m antara pesanan dan makanan)
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Primary Key ID Detail Pesanan
            // Foreign Key mengacu ke ID pada tabel orders (jika order dihapus, detail terhapus/cascade)
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            // Foreign Key mengacu ke ID pada tabel foods (jika makanan dihapus, detail terhapus/cascade)
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');
            $table->integer('quantity'); // Jumlah porsi/item yang dipesan
            $table->integer('subtotal'); // Subtotal harga (quantity * harga item)
            $table->timestamps(); // Timestamp otomatis
        });
    }

    /**
     * Hapus tabel order_details (Migration Down).
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details'); // Hapus tabel order_details jika rollback
    }
};
