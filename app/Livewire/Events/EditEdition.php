<?php

namespace App\Livewire\Events;

use App\Models\Contact;
use Livewire\Component;

class EditEdition extends Component
{
    public $students;

    public $evaluators;

    public function mount()
    {
        $this->students = Contact::where('role', 'student')->get();
        $this->evaluators = Contact::where('role', 'evaluators')->get();
    }

    public function addStudent()
    {
        $this->students[] = new Contact();
    }

    public function save(Contact $student)
    {
        $student->save();
    }

    public function render()
    {
        return view('livewire.events.edit-edition');
    }
}
