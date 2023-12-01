<?php

namespace App\Livewire\Events\Create;

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
            ? Project::where('name', 'like', '%'.$this->projectname.'%')->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function addProject(Project $project)
    {
        $event = Event::find($this->eventId);

        if (! $event->projects()->where('project_id', $project->id)->exists()) {
            //            dd($event->projects());
            $event->projects()->attach($project->id);
        }

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        $this->tasks = $this->getTasks();

        return view('livewire.events.create.search-list-project', ['tasks' => $this->tasks]);
    }

    // Define the getTasks method
    public function getTasks()
    {
        // Return only the task link to the specific project
        return $this->searchList->flatMap(function ($project) {
            return json_decode($project->tasks);
        })->unique();
    }
}
