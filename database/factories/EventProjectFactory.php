<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventProject;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventProjectFactory extends Factory
{
    protected $model = EventProject::class;

    public function definition()
    {
        return [
            'ponderation1' => $this->faker->numberBetween(1, 100),
            'ponderation2' => $this->faker->numberBetween(1, 100),
            'link' => $this->faker->url(),
        ];
    }
}
