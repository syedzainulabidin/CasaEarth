<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'role' => 'admin',
                'tier' => 'free',
                'password' => Hash::make('123456'),
            ]
        );

        // Regular user
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'user',
                'role' => 'user',
                'tier' => 'free',
                'password' => Hash::make('123456'),
            ]
        );
        User::factory()->count(10)->create();

    }
}
