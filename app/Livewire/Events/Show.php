<?php

namespace App\Livewire\Events;

use Livewire\Component;

class Show extends Component
{
    public $event;

    public $contacts;

    public $students;

    public $evaluators;

    public function mount($event)
    {
        $this->event = auth()->user()->events()->findOrFail($event);

        $this->contacts = $this->event->eventContacts;

        $this->students = $this->contacts->where('role', 'student');
        $this->evaluators = $this->contacts->where('role', 'evaluator');
    }

    public function render()
    {
        return view('livewire.events.show')
            ->layout('layouts.event-dashboard');
    }
}
