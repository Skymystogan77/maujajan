<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Admin MauJajan',
            'email' => 'admin@maujajan.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun Customer / User
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@maujajan.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // 3. Data Makanan Awal
        $this->call(FoodSeeder::class);
    }
}
