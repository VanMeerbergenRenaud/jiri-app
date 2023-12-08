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
    protected $model = Duty::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
