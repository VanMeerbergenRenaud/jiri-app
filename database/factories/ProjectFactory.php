<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->text(),
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
