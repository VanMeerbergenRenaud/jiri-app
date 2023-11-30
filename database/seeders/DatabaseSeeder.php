<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Duty;
use App\Models\Event;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dominique = User::factory()
            ->has(Event::factory()->count(2))
            ->has(Project::factory()->count(4))
            ->has(Contact::factory()->count(20))
            ->create([
                'name' => 'Dominique Vilain',
                'email' => 'dominique.vilain@hepl.be',
                'password' => bcrypt('password'),
            ]);

        $renaud = User::factory()
            ->has(Event::factory()->count(12))
            ->has(Project::factory()->count(12))
            ->has(Contact::factory()->count(24))
            //->has(Duty::factory()->count(15))
            ->create([
                'name' => 'Renaud Vmb',
                'email' => 'renaud.vmb@gmail.com',
                'password' => bcrypt('password'),
            ]);

        $users = collect([$dominique, $renaud]);

        foreach ($users as $user) {
            foreach ($user->events as $event) {
                $selectedContacts = $user->contacts->random(random_int(2, 10));

                foreach ($selectedContacts as $contact) {
                    $role = random_int(0, 1) ? 'students' : 'evaluators'; // Determine the role for each contact individually

                    $event->$role()->attach([
                        $contact->id => [
                            'role' => str($role)->beforeLast('s'), // Le rôle est stocké dans la table pivot sans le 's' final
                        ]
                    ]);

                    if ($role === 'students') {
                        $contact->projects()->attach(
                            $user->projects->random(3),
                            [
                                'duty_id' => $event->id,
                                'urls' => json_encode([
                                    'github' => 'https://github.com',
                                    'trello' => 'https://trello.com'], JSON_THROW_ON_ERROR),
                            ]
                        );
                    }
                }
            }
        }
    }
}
