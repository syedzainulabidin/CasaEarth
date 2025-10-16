<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GuideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'file_path' => 'guide/'.$this->faker->sentence(4).'pdf',
            'tier' => $this->faker->randomElement(['free', 'premium', 'advance']),
        ];
    }
}
