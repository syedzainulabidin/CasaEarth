<?php

// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $defaultTier = Tier::where('title', 'Free')->first();

        if (!$defaultTier) {
            throw new \Exception('No default tier found. Run TierSeeder first.');
        }

        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'role' => 'admin',
                'tier_id' => $defaultTier->id,
                'password' => Hash::make('123456'),
            ]
        );

        // Regular user
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'user',
                'role' => 'user',
                'tier_id' => $defaultTier->id,
                'password' => Hash::make('123456'),
            ]
        );

        // 10 more users with random tiers
        User::factory()->count(10)->create();
    }
}
