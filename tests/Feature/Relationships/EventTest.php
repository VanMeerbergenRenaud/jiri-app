<?php

use App\Models\Contact;
use App\Models\Event;
use App\Models\User;


it('is possible to fetch the students and the evaluators participating to a event', function () {
    //Create a user with a event
    $user = User::factory()
        ->has(Event::factory())
        ->create();

    //Create three contacts
    $students = Contact::factory()
        ->count(3)
        ->create([
            'user_id' => $user->id,
        ]);

    //Attach the contacts to the event as students
    $user->events->first()->students()->attach($students, ['role' => 'student']);

    //Check that the event has three students
    expect($user->events->first()->students)->toHaveCount(3);

    //Create five other contacts
    $evaluators = Contact::factory()
        ->count(5)
        ->create([
            'user_id' => $user->id,
        ]);

    //Attach the contacts to the event as students
    $user->events->first()->evaluators()->attach($evaluators, ['role' => 'evaluator', 'token' => str()->random(32)]);

    //Check that the event has three students
    expect($user->events->first()->evaluators)->toHaveCount(5);
});
