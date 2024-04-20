<?php

namespace App\Livewire\Events\Edit;

use Livewire\Component;

class Ponderation extends Component
{
    public $event;

    public $projects;

    public $totalPercentage = 100;
    public $remainingPercentage = 25;

    public function mount($event)
    {
        $this->event = $event;
        $this->projects = $this->event->projects;
    }

    public function render()
    {
        return view('livewire.events.edit.ponderation');
    }
}
