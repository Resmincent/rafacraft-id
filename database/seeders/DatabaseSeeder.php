<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Ensure you import Hash

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uncomment if you want to create 10 other users
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'rafa',
            'email' => 'admin@superadmin.com',
            'password' => Hash::make('@admin123'),
            'is_admin' => true,
        ]);
    }
}
