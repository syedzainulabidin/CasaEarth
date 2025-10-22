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
        $i = rand(1, 3);

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'file_path' => 'guides/CasaEarthGuide-'.$i.'.pdf',
            'tier' => $this->faker->randomElement(['free', 'premium', 'advance']),
        ];
    }
}
