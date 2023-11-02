<?php

use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('displays a form to create a jiri', function () {
    $user = User::factory()
        ->create();

    actingAs($user)
        ->get('jiris/create')
        ->assertSee('Create a new jiri')
        ->assertSee('form')
        ->assertSee('Name')
        ->assertSee('Starting date and time')
        ->assertSee('Duration in minutes');
});

it('creates a jiri', function () {
    $user = User::factory()
        ->create();
    $startingAt = now();

    actingAs($user)
        ->post('jiris', [
            'name' => 'Jiri 1',
            'starting_at' => $startingAt,
            'duration' => 60,
        ])
        ->assertRedirect('/jiris');

    $this->assertDatabaseHas('jiris', [
        'name' => 'Jiri 1',
        'starting_at' => $startingAt,
        'duration' => 60,
    ]);
});
