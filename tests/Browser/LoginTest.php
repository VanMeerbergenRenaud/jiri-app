<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/start')
                ->assertSee('Bienvenue');
        });

        /*$user = User::factory()->create([
            'email' => 'renaud.vmb@gmail.com',
            'password' => 'password',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(route('events.create'))
                ->type('@name', 'My Event')
                ->type('@starting_at', '2023-01-01T00:00')
                ->type('@duration', '1')
                ->press('Sauvegarder')
            ;
        });*/
    }
}
