<?php

namespace App\Livewire\Events\Edit;

use App\Livewire\Forms\EventForm;
use Livewire\Component;

class Container extends Component
{
    public $event;
    public EventForm $form;

    public $projects;

    public $totalPercentage = 100;
    public $remainingPercentage = 25;

    public function mount()
    {
        $this->form->setEvent($this->event);
        $this->projects = $this->event->eventProjects;
    }

    public function save()
    {
        $this->form->update();

        $this->event->refresh();

        return redirect()->route('events.index');
    }

    public function render()
    {
        return view('livewire.events.edit.container');
    }
}
