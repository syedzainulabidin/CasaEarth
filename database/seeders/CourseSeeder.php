<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

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
                'link' => 'https://youtu.be/fW1SgnTEqh4?si=aSG-IFPsYSO4Kkij',
                'description' => 'An introductory course on Laravel framework.',
                'tier' => 'intro',
            ],
            [
                'title' => 'Fullstack Web Development',
                'link' => 'https://youtu.be/2nHO49Fw7PE?si=fITdsX9VlPrVdGEC',
                'description' => 'Covers frontend and backend web development topics.',
                'tier' => 'all',
            ],
            [
                'title' => 'Free JavaScript Bootcamp',
                'link' => 'https://youtu.be/t32CIAw0fNc?si=StkP-D8mzIt8OCaI',
                'description' => 'Free beginner bootcamp for JavaScript learners.',
                'tier' => 'free',
            ],
            [
                'title' => 'Advanced PHP Techniques',
                'link' => 'https://youtu.be/MgY01n03QLU?si=VWDAg83Khq-zH37-',
                'description' => 'Deep dive into PHP for experienced developers.',
                'tier' => 'advance',
            ],
            [
                'title' => 'Premium Laravel Testing',
                'link' => 'https://youtu.be/4cHwoLLT-2g?si=WuETObQVRjAX9c7q',
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
