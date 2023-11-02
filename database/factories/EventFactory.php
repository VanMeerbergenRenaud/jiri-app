<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Event ' . $this->faker->word,
            'starting_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'duration' => $this->faker->numberBetween(120, 480),
        ];
    }
}
