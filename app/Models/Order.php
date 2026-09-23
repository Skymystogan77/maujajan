<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'orders';

    // Mengizinkan mass-assignment untuk semua kolom kecuali ID
    protected $guarded = ['id'];

    /**
     * Relasi One-to-Many: Satu Pesanan Memiliki Banyak Detail Pesanan
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
