<?php

namespace Database\Factories;

use App\Models\Implementation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Implementation>
 */
class ImplementationFactory extends Factory
{
    protected $model = Implementation::class;

    public function definition(): array
    {
        return [
            'url' => $this->faker->url(),
            'score' => $this->faker->numberBetween(0, 20),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
