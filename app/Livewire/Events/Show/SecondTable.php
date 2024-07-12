<?php

namespace App\Livewire\Events\Show;

use Livewire\Component;

class SecondTable extends Component
{
    public $event;

    public $contacts;

    public $students;

    public $evaluators;

    public $projects;

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

        $this->projects = $this->event->projects;
    }

    public function render()
    {
        return view('livewire.events.show.second-table');
    }
}
