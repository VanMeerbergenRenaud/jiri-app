<?php

namespace App\Livewire\Events\Create;

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
            ? Project::where('name', 'like', '%'.$this->projectname.'%')->orderBy('name', 'asc')->get()
            : new Collection();
    }

    public function addDuty($projectId)
    {
        $event = Event::find($this->eventId);
        $project = Project::find($projectId);

        if (!$event->duties()->where('project_id', $project->id)->exists()) {
            $duty = new Duty();
            $duty->name = $project->name;
            $duty->tasks = $project->tasks;
            $duty->event_id = $event->id;
            $duty->project_id = $project->id;
            $duty->user_id = auth()->user()->id;
            $duty->save();
        }

        $this->dispatch('fetchEventProjects');
    }

    public function getTasks()
    {
        // Return only the task link to the specific project
        return $this->searchList->flatMap(function ($project) {
            return json_decode($project->tasks);
        })->unique();
    }

    public function render()
    {
        $this->tasks = $this->getTasks();

        return view('livewire.events.create.search-list-project', ['tasks' => $this->tasks]);
    }
}
