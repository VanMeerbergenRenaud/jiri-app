<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/start')
                ->assertSee('Bienvenue');
        });

        /*$user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->LoginAs($user)
                ->visit(route('events.create'))
                ->type('@name', 'My Event')
                ->type('@starting_at', '2021-01-01 00:00:00')
                ->type('@duration', '1')
                ->press('Sauvegarder')
            ;
        });*/
    }
}
