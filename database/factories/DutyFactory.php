<?php

namespace Database\Factories;

use App\Models\Duty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Duty>
 */
class DutyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => $this->faker->numberBetween(1, 10),
            'project_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
