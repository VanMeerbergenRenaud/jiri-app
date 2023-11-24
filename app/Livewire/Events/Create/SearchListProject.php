<?php

namespace App\Livewire\Events\Create;

use App\Models\Project;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchListProject extends Component
{
    public $tasks;

    public $eventId;

    public $projectname = '';

    public function mount() {
        $this->tasks = $this->getUniqueTasks();
    }

    public function getUniqueTasks()
    {
        return Project::all()->flatMap(function ($project) {
            return json_decode($project->tasks);
        })->unique();
    }

    #[Computed]
    public function searchList() {
        return $this->projectname
            ? Project::where('name', 'like', '%' . $this->projectname . '%')->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function addProject(Project $project)
    {
        $event = Event::find($this->eventId);

        if (!$event->projects()->where('project_id', $project->id)->exists()) {
//            dd($event->projects());
            $event->projects()->attach($project->id);
        }

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.create.search-list-project');
    }
}
