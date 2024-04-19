<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Contact;
use App\Models\eventProject;
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

            // Attendances for each event
            foreach ($events as $event) {
                $contacts = $user->contacts->random(6);

                foreach ($contacts as $contact) {
                    Attendance::factory()->create([
                        'event_id' => $event->id,
                        'contact_id' => $contact->id,
                    ]);
                }
            }

            // eventProjects for each event
            foreach ($events as $event) {
                $projects = $user->projects->random(5);

                $totalPonderation = 0;
                $ponderations = [];

                foreach ($projects as $project) {
                    $ponderation = mt_rand(1, 100);
                    $totalPonderation += $ponderation;
                    $ponderations[] = $ponderation;
                }

                // Adjust ponderations if total is not 100
                if ($totalPonderation !== 100) {
                    $ponderations = array_map(function ($ponderation) use ($totalPonderation) {
                        return round(($ponderation / $totalPonderation) * 100);
                    }, $ponderations);
                }

                $ponderationsSum = array_sum($ponderations);
                if ($ponderationsSum != 100) {
                    $ponderations[0] += 100 - $ponderationsSum;
                }

                foreach ($projects as $index => $project) {
                    EventProject::factory()->create([
                        'event_id' => $event->id,
                        'project_id' => $project->id,
                        'ponderation' => $ponderations[$index],
                    ]);
                }
            }
        }
    }
}
