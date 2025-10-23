<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TierSeeder::class,
            UserSeeder::class,
            TherapistSeeder::class,
            BlogSeeder::class,
            CourseSeeder::class,
            AppointmentSeeder::class,
            EventSeeder::class,
            // GuideSeeder::class,
        ]);
    }
}
