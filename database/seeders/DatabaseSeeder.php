<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Project;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use function Laravel\Prompts\password;

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
            ->has(Event::factory()->count(2))
            ->has(Project::factory()->count(4))
            ->has(Contact::factory()->count(20))
            ->create([
                'name' => 'Renaud Vmb',
                'email' => 'renaud.vmb@gmail.com',
                'password' => bcrypt('password'),
            ]);

        $users = collect([$dominique, $renaud]);

        foreach ($users as $user) {
            foreach ($user->events as $event) { 
                // Pour chaque événement : on sélectionne un nombre aléatoire d'objets Contact associés à l'utilisateur.
                $selectedContacts = $user->contacts->random(random_int(2, 10));

                foreach ($selectedContacts as $contact) {
                    $role = random_int(0, 1) ? 'students' : 'evaluators'; // On détermine un rôle (soit 'students', soit 'evaluators')
                    $event->$role()->attach([
                        $contact->id => [
                            'role' => str($role)->beforeLast('s'), // Le rôle est stocké dans la table pivot sans le 's' final
                        ]
                    ]);

                    if ($role === 'students') {
                        $contact->projects()->attach(
                            $user->projects->random(3),
                            [
                                'event_id' => $event->id,
                                'urls' => json_encode([
                                    'github' => 'https://github.com',
                                    'trello' => 'https://trello.com'], JSON_THROW_ON_ERROR),
                            ]
                        );
                    }
                    if ($role === 'evaluators') {
                        // on génère un token d'accès pour l'évaluateur et on le stocke dans la table pivot.
                        $contact->events()->updateExistingPivot(
                            $event->id, [
                            'token' => Str::random(32),
                        ]);
                    }
                }
            }
        }
    }
}
