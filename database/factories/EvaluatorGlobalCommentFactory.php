<?php

namespace Database\Factories;

use App\Models\EvaluatorGlobalComment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EvaluatorGlobalComment>
 */
class EvaluatorGlobalCommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'globalComment' => $this->faker->text(),
            //'globalCote' => $this->faker->numberBetween(0, 20),
        ];
    }
}
