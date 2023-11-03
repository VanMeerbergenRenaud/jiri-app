<?php

use App\Models\Contact;
use App\Models\Event;
use App\Models\User;

it('is possible to fetch the events belonging to a user', function () {
    $user = User::factory()
        ->has(Event::factory(4))
        ->create();
    // Testing the existence of the relationship
    expect($user->events)->toHaveCount(4);
});

it('is possible to fetch all the contacts of a user', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create([
        'user_id' => $user->id,
    ]);
    $contacts = Contact::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);
    $event->contacts()->attach($contacts);

    // assert that the use has 3 contacts
    expect($user->contacts()->count())->toBe(3);
});

it('is not possible for a user to fetch the events of another user', function () {
    $user = User::factory()
        ->has(Event::factory(4))
        ->create();
    $anotherUser = User::factory()
        ->has(Event::factory(4))
        ->create();

    // Testing the existence of the relationship
    expect($user->events)->toHaveCount(4)
        ->and($anotherUser->events)->toHaveCount(4)
        ->and($user->events)->not->toBe($anotherUser->events);
});
