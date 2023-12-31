<?php

use App\Models\Event;
use App\Models\Scopes\AuthUserScope;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('scopes the events to the authenticated user', function () {
    // Make a user with 4 jiris
    $user = User::factory()
        ->has(Event::factory(4))
        ->create();

    // Make another user with 4 events
    User::factory()
        ->has(Event::factory(4))
        ->create();
    // Total of 8 jiris

    // Authenticate $user
    actingAs($user);

    // Check that the scope is applied, giving us 4 jiris
    // and that removing it gives us 8 jiris
    expect(Event::all())->toHaveCount(4)
        ->and(Event::withoutGlobalScope(AuthUserScope::class)->count())->toBe(8);
});
