<?php

use App\Models\User;
use function Pest\Laravel\{actingAs, get};

it('redirects the unauthenticated user to the login page', function () {
    get('/')
        ->assertRedirect('/login');
});

it('displays its jiris to the authenticated user', function () {
    $user = User::factory()->create();
    actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertSee('Your Jiris');
});
