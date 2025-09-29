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
                'title' => 'SQL Course for Beginners [Full Course]',
                'link' => 'https://www.youtube.com/watch?v=7S_tz1z_5bA',
                'description' => 'Master SQL – an essential skill for AI, machine learning, data analysis, and more! 📚 This beginner-friendly course teaches you SQL from scratch.',
                'tier' => 'intro',
            ],
            [
                'title' => 'Laravel + Livewire todo app (and so much more)',
                'link' => 'https://www.youtube.com/watch?v=oAUbpUcgGx0',
                'description' => 'Using Laravel to create a todo app is like using a Lambo to go to the grocery store. You can do it... but you can do so much more!',
                'tier' => 'all',
            ],
            [
                'title' => 'Learn JSON - Full Crash Course for Beginners',
                'link' => 'https://www.youtube.com/watch?v=GpOO5iKzOmY',
                'description' => 'Learn everything you need to know about JSON in 10 minutes. You will learn:
what JSON is, 
why JSON is important, 
what JSON is used for, 
the syntax of JSON, 
and see multiple examples of JSON. ',
                'tier' => 'free',
            ],
            [
                'title' => 'JavaScript Tutorial Full Course - Beginner to Pro',
                'link' => 'https://www.youtube.com/watch?v=EerdGm-ehJQ',
                'description' => '🎓 Includes certificate of completion and better learning experience (smaller videos, ads-free) ',
                'tier' => 'advance',
            ],
            [
                'title' => 'Angular for Beginners Course [Full Front End Tutorial with TypeScript]',
                'link' => 'https://www.youtube.com/watch?v=3qBXWUpoPHo',
                'description' => 'Learn Angular in this complete course for beginners. First you will learn the basics of Typescript and then you will learn about important Angular concepts such as binding, dependency injection, forms, routing, and more. 
',
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
