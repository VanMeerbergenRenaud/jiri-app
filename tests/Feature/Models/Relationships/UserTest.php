<?php

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Scopes\AuthUserScope;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('is possible to fetch all the attendances to a Jiri belonging to the authenticated user', function () {
    $user = User::factory()
        ->hasJiris(2)
        ->create();

    $contacts = Contact::factory()->count(10)->create([
        'user_id' => $user->id,
    ]);

    actingAs($user);
    Jiri::first()->contacts()->attach($contacts->take(2));
    Jiri::find(2)?->contacts()->attach($contacts->take(5));

    expect($user->contacts()->count())->toBe(10)
        ->and(Jiri::first()->attendances->count())->toBe(2)
        ->and(Jiri::find(2)?->attendances->count())->toBe(5);
});

it('is not possible for a user to fetch the jiris of another user', function () {
    $user = User::factory()
        ->hasJiris(4)
        ->create();

    $anotherUser = User::factory()
        ->hasJiris(4)
        ->create();

    // Testing the existence of the relationship
    // AnotherUser is not authenticated and thus
    // we should not retrieve his jiris

    actingAs($user);
    expect(Jiri::all())->toHaveCount(4)
        ->and($anotherUser->jiris)->toHaveCount(0);
});
