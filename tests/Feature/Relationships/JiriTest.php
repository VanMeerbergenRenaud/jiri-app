<?php

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\User;


it('is possible to fetch the students and the evaluators participating to a jiri', function () {
    //Create a user with a jiri
    $user = User::factory()
        ->has(Jiri::factory())
        ->create();

    //Create three contacts
    $students = Contact::factory()
        ->count(3)
        ->create([
            'user_id' => $user->id,
        ]);

    //Attach the contacts to the jiri as students
    $user->jiris->first()->students()->attach($students, ['role' => 'student']);

    //Check that the jiri has three students
    expect($user->jiris->first()->students)->toHaveCount(3);

    //Create five other contacts
    $evaluators = Contact::factory()
        ->count(5)
        ->create([
            'user_id' => $user->id,
        ]);

    //Attach the contacts to the jiri as students
    $user->jiris->first()->evaluators()->attach($evaluators, ['role' => 'evaluator', 'token' => str()->random(32)]);

    //Check that the jiri has three students
    expect($user->jiris->first()->evaluators)->toHaveCount(5);
});
