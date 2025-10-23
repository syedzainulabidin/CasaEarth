<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Tier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Therapist>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraphs(3, true),
            'date_time' => $this->faker->dateTimeBetween('+1 days', '+1 year'),
            'tier_id' => Tier::inRandomOrder()->value('id') ?? 1,
            'link' => $this->faker->url(),
        ];

    }
}
