<?php

namespace App\Livewire\Events\Edit;

use App\Models\Duty;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedListProject extends Component
{
    public $eventId;

    public Collection $dutiesList;

    public function mount()
    {
        $this->fetchEventProjects();
    }

    #[On('fetchEventProjects')]
    public function fetchEventProjects()
    {
        $event = Event::find($this->eventId);
        $this->dutiesList = $event->duties;
    }

    public function removeContact(Duty $duty)
    {
        $duty->implementations()->delete();

        $duty->delete();

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.edit.added-list-project');
    }
}
