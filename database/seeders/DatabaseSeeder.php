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
use Database\Factories\ImplementationFactory;
use DB;
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
                foreach ($user->contacts as $contact) {
                    Attendance::factory()->count(10)->create([
                        'event_id' => $event->id,
                        'contact_id' => $contact->id,
                    ]);
                }
            }

            // Duties for each event
            foreach ($events as $event) {
                foreach ($user->projects as $project) {
                    Duty::factory()->count(10)->create([
                        'event_id' => $event->id,
                        'project_id' => $project->id,
                    ]);

                    Implementation::factory()->count(10)->create([
                        'duty_id' => $event->duty->id,
                        'contact_id' => $user->contact->id,
                    ]);

                    Task::factory()->count(3)->create([
                        'project_id' => $project->id,
                    ]);
                }
            }
        }
    }
}
