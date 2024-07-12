<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'name' => 'Jury '.$this->faker->word,
            'starting_at' => $this->faker->dateTimeBetween('-2 year', '+2 year')->format('Y-m-d\TH:i'),
            'duration' => $this->faker->date('H:i'),
        ];
    }
}
