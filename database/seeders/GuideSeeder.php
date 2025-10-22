<?php

namespace Database\Seeders;

use App\Models\Guide;
use Illuminate\Database\Seeder;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePaths = [
            'guides/CasaEarthGuide-1.pdf',
            'guides/CasaEarthGuide-2.pdf',
            'guides/CasaEarthGuide-3.pdf',
        ];

        foreach ($filePaths as $path) {
            Guide::factory()->create([
                'file_path' => $path,
            ]);
        }
    }
}
