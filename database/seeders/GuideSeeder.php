<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guide;


class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guide::factory()->count(10)->create();

    }
}
