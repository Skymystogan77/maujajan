<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'order_details';

    // Proteksi kolom ID saja
    protected $guarded = ['id'];

    /**
     * Relasi Many-to-One: Detail Pesanan Milik Satu Pesanan Utama (Order)
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Relasi Many-to-One: Detail Pesanan Milik Satu Item Makanan (Food)
     */
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
