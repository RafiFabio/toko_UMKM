<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder untuk admin, seller, dan user
        $this->call([
            AdminSeeder::class,
            SellerSeeder::class,
            UserSeeder::class,
        ]);

        // Contoh tambahan user dummy
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password123'),
        //     'role' => 'user',
        // ]);
    }
}
