<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Therapist>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'heading' => $this->faker->sentence, // generates a realistic blog post title
            'content' => $this->faker->paragraphs(3, true), // ~100 words in 5 paragraphs as one string
        ];

    }
}
