<?php

namespace Database\Factories;

use App\Models\EventContact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<EventContact>
 */
class EventContactFactory extends Factory
{
    protected $model = EventContact::class;

    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(['student', 'evaluator']),
            'token' => $this->faker->sha256(),
        ];
    }
}
