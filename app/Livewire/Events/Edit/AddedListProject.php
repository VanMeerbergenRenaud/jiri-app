<?php

namespace App\Livewire\Events\Edit;

use App\Models\ProjectPonderation;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedListProject extends Component
{
    public $event;

    public Collection $projectsList;

    public function mount($event)
    {
        $this->event = $event;
        $this->fetchEventProjects();
    }

    #[On('fetchEventProjects')]
    public function fetchEventProjects()
    {
        $this->projectsList = $this->event->projectPonderations;
    }

    public function removeProject(ProjectPonderation $projectPonderation)
    {
        $projectPonderation->delete();

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.edit.added-list-project');
    }
}
