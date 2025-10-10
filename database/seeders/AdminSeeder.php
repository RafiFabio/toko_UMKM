<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@umkm.com')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@umkm.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]);
        }
    }
}
