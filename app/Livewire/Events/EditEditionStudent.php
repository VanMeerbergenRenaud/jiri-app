<?php

namespace App\Livewire\Events;

use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Duty;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditEditionStudent extends Component
{
    public $students;
    public $editStudentId = null;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'firstname' => 'required|min:3|max:255',
        'email' => 'required|email',
    ];

    public $name;
    public $firstname;
    public $email;

    public $event_id;
    public $projects;

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

    // Create a student and add it to the event
    public function createStudent()
    {
        $this->validate();

        $student = auth()->user()->contacts()->create([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
        ]);

        Attendance::create([
            'contact_id' => $student->id,
            'event_id' => $this->event_id,
            'role' => 'student',
        ]);

        $student->save();

        session()->flash('message', 'Etudiant créé !.');
    }

    // Save a student from the event
    public function saveStudent($studentId)
    {
        $this->validate();

        $this->editStudentId = $studentId;

        $student = Contact::find($studentId);

        // Update the student
        $student->update([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Etudiant sauvegardé !.');
    }

    // Edit a student from the event
    public function editStudent($studentId)
    {
        $this->editStudentId = $studentId;

        $Student = $this->students->where('id', $studentId)->first();

        $this->name = $Student->name;
        $this->firstname = $Student->firstname;
        $this->email = $Student->email;

        session()->flash('message', 'Etudiant en cours d\'édition !.');
    }

    // Remove the student from the event
    public function removeStudent($studentId)
    {
        $student = Contact::find($studentId);

        Attendance::where('contact_id', $student->id)
            ->where('event_id', $this->event_id)
            ->where('role', 'student')
            ->delete();

        session()->flash('message', 'Etudiant supprimé !.');
    }

    // Save the form
    public function save()
    {
        $this->validate();

        foreach ($this->students as $student) {
            $student = Contact::find($student->id);

            // Update the student
            $student->update([
                'name' => $student->name,
                'firstname' => $student->firstname,
                'email' => $student->email,
            ]);
        }

        session()->flash('message', 'Étudiants sauvegardés !.');
    }

    public function render()
    {
        return view('livewire.events.edit-edition-student');
    }
}
