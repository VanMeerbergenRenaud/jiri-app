<?php

namespace Database\Factories;

use App\Models\ProjectPonderation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectPonderation>
 */
class ProjectPonderationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ponderation1' => $this->faker->randomFloat(2, 0, 100),
            'ponderation2' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
