<?php

namespace App\Livewire\Events\Edit;

use App\Models\Event;
use App\Models\EventProject;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedListProject extends Component
{
    public $eventId;

    public Collection $projectsList;

    public function mount()
    {
        $this->fetchEventProjects();
    }

    #[On('fetchEventProjects')]
    public function fetchEventProjects()
    {
        $event = auth()->user()->events()->findOrFail($this->eventId);
        $this->projectsList = $event->projects;
    }

    public function removeProject(Project $project)
    {
        $eventProject = EventProject::where('event_id', $this->eventId)
            ->where('project_id', $project->id)
            ->firstOrFail();

        $eventProject->delete();

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.edit.added-list-project');
    }
}
