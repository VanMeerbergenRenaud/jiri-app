<?php

use App\Models\Event;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('has a events index page accessible to authenticated users only', function () {
    $user = User::factory()
        ->create();

    get('events')
        ->assertRedirect('login');

    actingAs($user)
        ->get('events')
        ->assertOK();
});

it('displays only the events of the authenticated user', function () {
    $user = User::factory()
        ->create();
    $event = Event::factory()
        ->create([
            'user_id' => $user->id,
        ]);
    $anotherUser = User::factory()
        ->create();
    $anotherEvent = Event::factory()
        ->create([
            'user_id' => $anotherUser->id,
        ]);

    actingAs($user)
        ->get('events')
        ->assertSee($event->name)
        ->assertDontSee($anotherEvent->name);
});

it('displays the events in the chronological order', function(){
    $user = User::factory()
        ->create();

    $event1 = Event::factory()
        ->create([
            'user_id' => $user->id,
            'starting_at' => now()->addDay(),
        ]);
    $event2 = Event::factory()
        ->create([
            'user_id' => $user->id,
            'starting_at' => now(),
        ]);
    $event3 = Event::factory()
        ->create([
            'user_id' => $user->id,
            'starting_at' => now()->subDay(),
        ]);

    actingAs($user)
        ->get('events')
        ->assertSee($event3->name, $event2->name, $event1->name);
});

it('displays a link to a event creation page', function () {
    $user = User::factory()
        ->create();

    actingAs($user)
        ->get('events')
        ->assertSee('Créer une nouvelle épreuve');
});
