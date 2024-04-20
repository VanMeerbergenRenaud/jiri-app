<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Event;
use App\Models\EventContact;
use App\Models\eventProject;
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
            ->create([
                'name' => 'Renaud Van Meerbergen',
                'email' => 'renaud.vanmeerbergen@gmail.com',
                'password' => bcrypt('password'),
            ]);

        $renaud = User::factory()
            ->create([
                'name' => 'Renaud Vmb',
                'email' => 'renaud.vmb@gmail.com',
                'password' => bcrypt('password'),
            ]);

        User::factory()
            ->create([
                'name' => 'Test',
                'email' => 'test@gmail.com',
                'password' => bcrypt('password'),
            ]);

        $users = collect([$dominique, $renaud]);

        foreach ($users as $user) {
            Event::factory()->count(32)->create([
                'user_id' => $user->id,
            ]);

            Contact::factory()->count(25)->create([
                'user_id' => $user->id,
            ]);

            Project::factory()->count(12)->create([
                'user_id' => $user->id,
            ]);

            $events = $user->events;

            // Event Contacts for each event
            foreach ($events as $event) {
                $contacts = $user->contacts->random(6);

                foreach ($contacts as $contact) {
                    EventContact::factory()->create([
                        'event_id' => $event->id,
                        'contact_id' => $contact->id,
                    ]);
                }
            }

            // eventProjects for each event
            foreach ($events as $event) {
                $projects = $user->projects->random(5);

                $totalPonderation1 = 0;
                $totalPonderation2 = 0;
                $ponderations1 = [];
                $ponderations2 = [];

                foreach ($projects as $project) {
                    $ponderation1 = mt_rand(1, 100);
                    $ponderation2 = mt_rand(1, 100);
                    $totalPonderation1 += $ponderation1;
                    $totalPonderation2 += $ponderation2;
                    $ponderations1[] = $ponderation1;
                    $ponderations2[] = $ponderation2;
                }

                // Adjust ponderations if the total is not 100
                if ($totalPonderation1 !== 100) {
                    $ponderations1 = array_map(function ($ponderation) use ($totalPonderation1) {
                        return round(($ponderation / $totalPonderation1) * 100);
                    }, $ponderations1);
                }

                if ($totalPonderation2 !== 100) {
                    $ponderations2 = array_map(function ($ponderation) use ($totalPonderation2) {
                        return round(($ponderation / $totalPonderation2) * 100);
                    }, $ponderations2);
                }

                $ponderationsSum1 = array_sum($ponderations1);
                if ($ponderationsSum1 != 100) {
                    $ponderations1[0] += 100 - $ponderationsSum1;
                }

                $ponderationsSum2 = array_sum($ponderations2);
                if ($ponderationsSum2 != 100) {
                    $ponderations2[0] += 100 - $ponderationsSum2;
                }

                foreach ($projects as $index => $project) {
                    EventProject::factory()->create([
                        'event_id' => $event->id,
                        'project_id' => $project->id,
                        'ponderation1' => $ponderations1[$index],
                        'ponderation2' => $ponderations2[$index],
                    ]);
                }
            }
        }
    }
}
