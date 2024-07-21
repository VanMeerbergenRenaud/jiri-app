<?php

namespace App\Livewire\Events\Show;

use Livewire\Component;

class FirstTable extends Component
{
    public $event;

    public $contacts;

    public $students;

    public $evaluators;

    public function mount($event, $contacts, $students, $evaluators)
    {
        $this->event = $event;
        $this->contacts = $contacts;
        $this->students = $students;
        $this->evaluators = $evaluators;
    }

    public function render()
    {
        return view('livewire.events.show.first-table');
    }
}
