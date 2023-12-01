<?php

use App\Models\Contact;
use App\Models\Event;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('is possible to fetch the students and the evaluators participating to a event', function () {
    //Create a user with a event
    $user = User::factory()
        ->has(Event::factory())
        ->create();

    // Create three contacts
    $students = Contact::factory()
        ->count(3)
        ->create([
            'user_id' => $user->id,
        ]);

    // Log the user since the AuthUserScope requires an authenticated user
    // After that, every access to the Event model will be scoped to the user
    actingAs($user);

    // Attach the contacts to the event as students
    Event::first()->students()->attach($students, ['role' => 'student']);

    // Check that the jiri has three students
    expect(Event::first()->students)->toHaveCount(3);

    // Create five other contacts
    $evaluators = Contact::factory()
        ->count(5)
        ->create([
            'user_id' => $user->id,
        ]);

    //Attach the contacts to the jiri as students
    Event::first()->evaluators()->attach($evaluators, ['role' => 'evaluator', 'token' => str()->random(32)]);

    //Check that the jiri has three students
    expect(Event::first()->evaluators)->toHaveCount(5);
});
