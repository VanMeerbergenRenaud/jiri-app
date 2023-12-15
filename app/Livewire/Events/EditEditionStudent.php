<?php

namespace App\Livewire\Events;

use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Duty;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditEditionStudent extends Component
{
    use WithFileUploads;

    public $contact;
    public $search = '';

    public $event_id;
    public $projects;
    public $editStudentId; // Student id that is being edited

    public $name;
    public $firstname;
    public $email;
    // public $photo;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'firstname' => 'required|min:3|max:255',
        'email' => 'nullable|email',
        // 'photo' => 'image|max:1024|jpg,jpeg,png',
    ];

    public function mount()
    {
        // Get the event id from the url
        $this->event_id = request()->route('event');

        // Projects of the specific event
        $this->projects = Duty::where('event_id', $this->event_id)->get();
    }

    #[Computed]
    public function searchList()
    {
        return $this->contact
            ? Contact::where('name', 'like', '%'.$this->contact.'%')
                ->orWhere('firstname', 'like', '%'.$this->contact.'%')
                ->orWhere('email', 'like', '%'.$this->contact.'%')
                ->orderBy('name', 'asc')->get()
            : new Collection();
    }

    // Fetch the students of the event
    #[Computed]
    public function students()
    {
        return DB::table('contacts')
            ->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('attendances.event_id', $this->event_id)
            ->where('attendances.role', 'student')
            ->where(function($query) {
                $query->where('contacts.name', 'like', '%' . $this->search . '%')
                    ->orWhere('contacts.firstname', 'like', '%' . $this->search . '%');
            })
            ->select('contacts.id', 'contacts.name', 'contacts.firstname', 'contacts.email')
            ->get();
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

        $this->name = '';
        $this->firstname = '';
        $this->email = null;

        session()->flash('message', 'Etudiant créé !.');
    }

    // Save a student in the event
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

        $this->editStudentId = null;

        session()->flash('message', 'Etudiant sauvegardé !.');
    }

    // Edit a student in the event
    public function editStudent($studentId)
    {
        $this->editStudentId = $studentId;

        $studentIdFind = $this->students()->where('id', $studentId)->first();

        $this->name = $studentIdFind->name;
        $this->firstname = $studentIdFind->firstname;
        $this->email = $studentIdFind->email;

        session()->flash('message', 'Etudiant en cours d‘édition !.');
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

        $this->students();
    }
}
