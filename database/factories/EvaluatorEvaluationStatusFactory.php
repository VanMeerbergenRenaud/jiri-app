<?php

namespace Database\Factories;

use App\Models\evaluatorEvaluationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<evaluatorEvaluationStatus>
 */
class EvaluatorEvaluationStatusFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['not evaluated', 'pending', 'evaluated']),
            'public' => $this->faker->boolean(),
        ];
    }
}
