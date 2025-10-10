<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'seller@mail.com')->exists()) {
            User::create([
                'name' => 'Budi',
                'email' => 'seller@mail.com',
                'password' => Hash::make('password123'),
                'role' => 'seller',
            ]);
        }
    }
}
