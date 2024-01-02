<?php

/*
// Pas utile ici
use App\Models\User;
use function Pest\Laravel\{actingAs, get};

it('redirects the unauthenticated user to the home page', function () {
    get('/')->assertRedirect('/login');
});

it('displays its events to the authenticated user', function () {
    $user = User::factory()->configure();
    actingAs($user)
        ->get('/')
        ->assertOk()
        ->assertSee('Your Events');
});
*/
