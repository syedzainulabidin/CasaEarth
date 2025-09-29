<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Therapist>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'therapist_id' => Therapist::inRandomOrder()->first()?->id ?? Therapist::factory()->create()->id,
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected', 'completed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
}
