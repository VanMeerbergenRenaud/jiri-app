<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /* Seed the application's database */
    public function run(): void
    {
        $dominique = User::factory()
            ->has(Jiri::factory()->count(3))
            ->has(Contact::factory()->count(100))
            ->create([
                'name' => 'Dominique Vilain',
                'email' => 'dominique.vilain@hepl.be',
            ]);

        /*
        Using the existing jiris and the existing contacts, create the attendances
        by selecting 3 to 10 contacts for each jiri and attribute them randomly a
        role of student or evaluator
        */
        foreach ($dominique->jiris as $jiri) {
            $selectedContacts = $dominique->contacts->random(random_int(3, 10));
            foreach ($selectedContacts as $contact) {
                $role = random_int(0, 1) ? 'students' : 'evaluators';
                $jiri->$role()->attach([
                    $contact->id => [
                        'role' => str($role)->beforeLast('s'),
                    ]
                ]);
            }
        }
    }
}
