<?php

namespace Database\Factories;

use App\Models\EventGlobalComment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventGlobalComment>
 */
class EventGlobalCommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'globalComment' => $this->faker->text(),
        ];
    }
}
