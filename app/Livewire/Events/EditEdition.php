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

    public function save(Contact $student)
    {
        // update the information of the student to the contacts table
    }

    public function render()
    {
        return view('livewire.events.edit-edition');
    }
}
