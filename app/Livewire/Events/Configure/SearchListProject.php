<?php

namespace App\Livewire\Events\Configure;

use App\Models\Duty;
use App\Models\Event;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchListProject extends Component
{
    public $eventId;

    public $projectname = '';

    public $tasks = [];

    #[Computed]
    public function searchList()
    {
        return $this->projectname
            ? auth()->user()->projects()
                ->where('name', 'like', '%'.$this->projectname.'%')
                ->orderBy('name')
                ->get()
            : new Collection();
    }

    public function addDuty($projectId)
    {
        $event = Event::find($this->eventId);
        $project = Project::find($projectId);

        if (! $event->duties()->where('project_id', $project->id)->exists()) {
            auth()->user()->duties()->create([
                'event_id' => $event->id,
                'project_id' => $project->id,
                'name' => $project->name,
            ]);
        }

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.configure.search-list-project');
    }
}
