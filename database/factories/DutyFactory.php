<?php

namespace Database\Factories;

use App\Models\Duty;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
            'event_id' => $this->faker->numberBetween(1, 20),
            'project_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word(),
            'tasks' => json_encode($this->faker->randomElements(
                [
                    'Design',
                    'Integration',
                    'Wordpress',
                ], $this->faker->numberBetween(1, 3)
            )),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
