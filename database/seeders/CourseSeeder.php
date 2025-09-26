<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Laravel Basics',
                'link' => 'https://www.youtube.com/watch?v=SSKVgrwhzus',
                'description' => 'An introductory course on Laravel framework.',
                'tier' => 'intro',
            ],
            [
                'title' => 'Fullstack Web Development',
                'link' => 'https://www.youtube.com/watch?v=fW1SgnTEqh4',
                'description' => 'Covers frontend and backend web development topics.',
                'tier' => 'all',
            ],
            [
                'title' => 'Free JavaScript Bootcamp',
                'link' => 'https://www.youtube.com/watch?v=99QiOUql3cQ',
                'description' => 'Free beginner bootcamp for JavaScript learners.',
                'tier' => 'free',
            ],
            [
                'title' => 'Advanced PHP Techniques',
                'link' => 'https://www.youtube.com/watch?v=FJeri_EM64k',
                'description' => 'Deep dive into PHP for experienced developers.',
                'tier' => 'advance',
            ],
            [
                'title' => 'Premium Laravel Testing',
                'link' => 'https://www.youtube.com/watch?v=H2rNNf3LuXk',
                'description' => 'Test Laravel apps like a pro. Premium only.',
                'tier' => 'premium',
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['title' => $course['title']],
                $course
            );
        }
    }
}
