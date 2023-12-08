<?php

namespace App\Livewire\Events;

use App\Models\Attendance;
use App\Models\Duty;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EditEditionStudent extends Component
{
    public $students;

    // name, firstname, email validation rules
    public $rules = [
        'students.*.name' => 'required|string|min:2|max:255',
        'students.*.firstname' => 'required|string|min:2|max:255',
        'students.*.email' => 'nullable|email',
    ];

    public $projects;

    public $event_id;

    public function mount()
    {
        $this->event_id = request()->route('event');

        $this->students = DB::table('contacts')
            ->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('attendances.event_id', $this->event_id)
            ->where('attendances.role', 'student')
            ->select('contacts.id', 'contacts.name', 'contacts.firstname', 'contacts.email')
            ->get();

        // Projects of the specific event
        $this->projects = Duty::where('event_id', $this->event_id)->get();
    }

    // Save the students of the event
    public function save()
    {
        // save the form globally
        $this->validate();

        session()->flash('message', 'Student saved successfully.');

        // Save the student in the database
        foreach ($this->students as $student) {
            DB::table('contacts')
                ->where('id', $student->id)
                ->update([
                    'name' => $student->name,
                    'firstname' => $student->firstname,
                    'email' => $student->email,
                ]);
        }
    }


    // Add a student to the event
    public function addStudentToEvent()
    {
        $this->validate();

        Attendance::updateOrCreate([
            'event_id' => $this->event_id,
            'contact_id' => DB::table('contacts')->insertGetId([
                'name' => $this->students->last()['name'],
                'firstname' => $this->students->last()['firstname'],
                'email' => $this->students->last()['email'], // l'email peut être null pour un student
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => auth()->id(),
            ]),
            'role' => 'student',
        ]);
    }

    public function addStudentRow()
    {
        $this->students->push([
            'name' => '',
            'firstname' => '',
            'email' => '',
        ]);
    }

    // Remove the students that are not in the form
    public function removeStudents()
    {
        $students_id = $this->students->pluck('id')->toArray();

        Attendance::where('event_id', $this->event_id)
            ->where('role', 'student')
            ->whereNotIn('contact_id', $students_id)
            ->delete();
    }

    public function render()
    {
        return view('livewire.events.edit-edition-student');
    }
}
