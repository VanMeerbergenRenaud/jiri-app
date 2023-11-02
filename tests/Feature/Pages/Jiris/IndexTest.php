<?php

use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('has a jiris index page accessible to authenticated users only', function () {
    $user = User::factory()
        ->create();

    get('jiris')
        ->assertRedirect('login');

    actingAs($user)
        ->get('jiris')
        ->assertOK();

});

it('displays only the jiris of the authenticated user', function () {
    $user = User::factory()
        ->create();
    $jiri = Jiri::factory()
        ->create([
            'user_id' => $user->id,
        ]);
    $anotherUser = User::factory()
        ->create();
    $anotherJiri = Jiri::factory()
        ->create([
            'user_id' => $anotherUser->id,
        ]);

    actingAs($user)
        ->get('jiris')
        ->assertSee($jiri->name)
        ->assertDontSee($anotherJiri->name);
});

it('displays the jiris in the chronological order', function(){
    $user = User::factory()
        ->create();

    $jiri1 = Jiri::factory()
        ->create([
            'user_id' => $user->id,
            'starting_at' => now()->addDay(),
        ]);
    $jiri2 = Jiri::factory()
        ->create([
            'user_id' => $user->id,
            'starting_at' => now(),
        ]);
    $jiri3 = Jiri::factory()
        ->create([
            'user_id' => $user->id,
            'starting_at' => now()->subDay(),
        ]);

    actingAs($user)
        ->get('/jiris')
        ->assertSeeInOrder([$jiri3->name, $jiri2->name, $jiri1->name]);
});

it('displays a link to a jiri creation page', function () {
    $user = User::factory()
        ->create();

    actingAs($user)
        ->get('jiris')
        ->assertSee('Create a new jiri');
});
