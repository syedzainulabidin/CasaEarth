<?php

namespace Database\Factories;

use App\Models\Therapist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends Factory<Therapist>
 */
class TherapistFactory extends Factory
{
    protected $model = Therapist::class;

    public function definition(): array
    {
        // Generate two random 1-hour slots
        $slots = [];
        for ($i = 0; $i < 2; $i++) {
            $start = Carbon::createFromTime(rand(8, 17), [0, 30][rand(0, 1)]);
            $end = $start->copy()->addHour();
            $slots[] = $start->format('H:i') . '-' . $end->format('H:i');
        }

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'slots' => json_encode($slots),
            'days' => json_encode($this->faker->randomElements(
                ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                rand(2, 4)
            )),
            'charges' => $this->faker->numberBetween(50, 150),
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
