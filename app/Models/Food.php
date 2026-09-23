<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara eksplisit
    protected $table = 'foods';

    // Mengizinkan semua kolom diisi secara mass-assignment kecuali ID
    protected $guarded = ['id'];

    /**
     * Relasi One-to-Many: Satu Makanan bisa ada di banyak Detail Pesanan
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'food_id');
    }
}
