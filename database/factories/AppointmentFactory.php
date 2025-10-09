<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        // Random day of the week
        $day = $this->faker->randomElement([
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
        ]);

        // Random slot format (matching your system’s idea of slots)
        $slot = $this->faker->randomElement([
            '09:00-10:00',
            '10:00-11:00',
            '11:00-12:00',
            '01:00-02:00',
            '03:00-04:00',
        ]);

        return [
            'therapist_id' => Therapist::inRandomOrder()->first()?->id
                ?? Therapist::factory()->create()->id,

            'user_id' => User::where('role', 'user')->inRandomOrder()->first()?->id
                ?? User::factory()->create(['role' => 'user'])->id,

            'day' => $day,
            'date' => $this->faker->dateTimeBetween('now', '+3 weeks')->format('Y-m-d'),
            'slot' => $slot,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected', 'completed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
