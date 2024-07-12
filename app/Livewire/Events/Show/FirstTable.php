<?php

namespace App\Livewire\Events\Show;

use Livewire\Component;

class FirstTable extends Component
{
    public $event;

    public $contacts;

    public $students;

    public $evaluators;

    public function mount()
    {
        $this->event = auth()->user()->events()
            ->findOrFail(request()->route('event'));

        $this->contacts = auth()->user()->eventContacts()
            ->where('event_id', $this->event->id)
            ->with('contact')
            ->get();

        $this->students = $this->contacts->where('role', 'student');
        $this->evaluators = $this->contacts->where('role', 'evaluator');
    }

    public function render()
    {
        return view('livewire.events.show.first-table');
    }
}
