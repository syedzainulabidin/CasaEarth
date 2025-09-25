<?php

namespace Database\Factories;

use App\Models\Therapist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Therapist>
 */
class TherapistFactory extends Factory
{
    protected $model = Therapist::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'slots' => json_encode([
                $this->faker->time('H:i') . '-' . $this->faker->time('H:i'),
                $this->faker->time('H:i') . '-' . $this->faker->time('H:i'),
            ]),
            'days' => json_encode($this->faker->randomElements(
                ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                rand(2, 4)
            )),
            'specialization' => $this->faker->randomElement([
                'Cognitive Behavioral Therapy',
                'Psychodynamic Therapy',
                'Family Therapy',
                'Art Therapy',
                'Child Therapy',
            ]),
        ];
    }
}
