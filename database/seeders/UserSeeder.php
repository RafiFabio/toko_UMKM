<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'user@mail.com')->exists()) {
            User::create([
                'name' => 'Rafi',
                'email' => 'user@mail.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);
        }
    }
}
