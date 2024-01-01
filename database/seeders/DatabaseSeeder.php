<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Duty;
use App\Models\Event;
use App\Models\Implementation;
use App\Models\Project;
use App\Models\Task;
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
                $contacts = $user->contacts->random(3);

                foreach ($contacts as $contact) {
                    Attendance::factory()->count(8)->create([
                        'event_id' => $event->id,
                        'contact_id' => $contact->id,
                    ]);
                }
            }

            // Duties for each event
            foreach ($events as $event) {
                $projects = $user->projects->random(3);

                foreach ($projects as $project) {
                    Duty::factory()->count(2)->create([
                        'event_id' => $event->id,
                        'project_id' => $project->id,
                    ]);

                    Task::factory()->count(1)->create([
                        'project_id' => $project->id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            // Implementations for each event (duty & contact id)
            foreach ($events as $event) {
                $duties = $event->duties;

                foreach ($duties as $duty) {
                    $contacts = $event->contacts->random(2);

                    foreach ($contacts as $contact) {
                        Implementation::factory()->count(1)->create([
                            'duty_id' => $duty->id,
                            'contact_id' => $contact->id,
                        ]);
                    }
                }
            }
        }
    }
}
