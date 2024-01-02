<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

it('displays a form to configure a event', function () {
    $user = User::factory()
        ->create();

    actingAs($user)
        ->get('events/configure')
        ->assertSee('C’est parti pour une nouvelle expérience')
        ->assertSee('form')
        ->assertSee('Nom')
        ->assertSee('Date')
        ->assertSee('Durée');
});

it('creates a event', function () {
    $user = User::factory()
        ->create();
    $startingAt = now();

    actingAs($user)
        ->post('events', [
            'name' => 'Event 1',
            'starting_at' => $startingAt,
            'duration' => 60,
        ])
        ->assertRedirect('/events');

    $this->assertDatabaseHas('events', [
        'name' => 'Event 1',
        'starting_at' => $startingAt,
        'duration' => 60,
    ]);
});
