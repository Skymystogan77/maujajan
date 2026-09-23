<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            [
                'name' => 'Nasi Goreng Spesial',
                'category' => 'Makanan',
                'price' => 20000,
                'description' => 'Nasi goreng lezat dengan telur, ayam suwir, dan kerupuk.',
                'image' => null,
            ],
            [
                'name' => 'Mie Ayam Bakso',
                'category' => 'Makanan',
                'price' => 18000,
                'description' => 'Mie ayam kenyal dipadukan dengan bakso sapi gurih.',
                'image' => null,
            ],
            [
                'name' => 'Es Teh Manis',
                'category' => 'Minuman',
                'price' => 5000,
                'description' => 'Es teh segar manis pembunuh dahaga.',
                'image' => null,
            ],
            [
                'name' => 'Es Jeruk Segar',
                'category' => 'Minuman',
                'price' => 7000,
                'description' => 'Minuman es jeruk peras alami kaya vitamin C.',
                'image' => null,
            ],
            [
                'name' => 'Kentang Goreng',
                'category' => 'Cemilan',
                'price' => 12000,
                'description' => 'Kentang goreng renyah disajikan dengan saus sambal.',
                'image' => null,
            ],
            [
                'name' => 'Pisang Goreng Keju',
                'category' => 'Cemilan',
                'price' => 10000,
                'description' => 'Pisang goreng crispy berselimut keju parut dan susu kental manis.',
                'image' => null,
            ],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
