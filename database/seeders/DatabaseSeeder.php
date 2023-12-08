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
                'name' => 'Dominique Vilain',
                'email' => 'dominique.vilain@hepl.be',
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
            Event::factory()->count(20)->create([
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
                    Attendance::factory()->count(2)->create([
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
                    ]);
                }
            }
        }
    }
}
