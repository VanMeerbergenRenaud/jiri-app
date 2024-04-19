<?php

namespace App\Livewire\Events\Edit;

use App\Livewire\Forms\EventForm;
use Livewire\Component;

class Container extends Component
{
    public $event;
    public EventForm $form;

    public $projects;// make a new component for this
    public $totalPercentage = 100;// make a new component for this
    public $remainingPercentage = 25;// make a new component for this

    public function mount()
    {
        $this->form->setEvent($this->event);
        $this->projects = $this->event->projects;// make a new component for this
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
