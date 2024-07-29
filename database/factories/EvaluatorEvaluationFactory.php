<?php

namespace Database\Factories;

use App\Models\EvaluatorEvaluation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EvaluatorEvaluation>
 */
class EvaluatorEvaluationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'score' => $this->faker->randomFloat(2, 0, 20),
            'comment' => $this->faker->text(),
            'status' => $this->faker->randomElement(['not evaluated', 'pending', 'evaluated']),
            'timer' => $this->faker->time(),
        ];
    }
}
