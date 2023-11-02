<?php

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Scopes\AuthUserScope;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('scopes the jiris to the authenticated user', function () {
    // Make a user with 4 jiris
    $user = User::factory()
        ->has(Jiri::factory(4))
        ->create();

    // Make another user with 4 jiris
    User::factory()
        ->has(Jiri::factory(4))
        ->create();
    // Total of 8 jiris

    // Authenticate $user
    actingAs($user);

    // Check that the scope is applied, giving us 4 jiris
    // and that removing it gives us 8 jiris
    expect(Jiri::all())->toHaveCount(4)
    ->and(Jiri::withoutGlobalScope(AuthUserScope::class)->count())->toBe(8);
});
