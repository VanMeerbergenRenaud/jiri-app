<?php

namespace App\Livewire\Events\Create;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedListProject extends Component
{
    public $eventId;

    public Collection $projectsList;

    public function mount() {
        $event = Event::find($this->eventId);
        $this->projectsList = $event ? $event->projects : new Collection();
    }

    #[On('fetchEventProjects')]
    public function fetchEventProjects()
    {
        $event = Event::find($this->eventId);

        $this->projectsList = $event->projects;
    }

    public function removeProject($projectId)
    {
        $event = Event::find($this->eventId);

        $event->projects()->detach($projectId);

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.create.added-list-project');
    }
}
