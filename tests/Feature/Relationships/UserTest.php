<?php

use App\Models\Contact;
use App\Models\Event;
use App\Models\User;

it('is possible to fetch the jiris belonging to a user', function () {
    $user = User::factory()
        ->has(Event::factory(4))
        ->create();
    // Testing the existence of the relationship
    expect($user->jiris)->toHaveCount(4);
});

it('is possible to fetch all the contacts of a user', function () {
    $user = User::factory()->create();
    $jiri = Event::factory()->create([
        'user_id' => $user->id,
    ]);
    $contacts = Contact::factory()->count(3)->create([
        'user_id' => $user->id,
    ]);
    $jiri->contacts()->attach($contacts);

    // assert that the use has 3 contacts
    expect($user->contacts()->count())->toBe(3);
});

it('is not possible for a user to fetch the jiris of another user', function () {
    $user = User::factory()
        ->has(Event::factory(4))
        ->create();
    $anotherUser = User::factory()
        ->has(Event::factory(4))
        ->create();

    // Testing the existence of the relationship
    expect($user->jiris)->toHaveCount(4)
        ->and($anotherUser->jiris)->toHaveCount(4)
        ->and($user->jiris)->not->toBe($anotherUser->jiris);
});
