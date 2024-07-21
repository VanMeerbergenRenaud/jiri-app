<?php

namespace App\Livewire\Events\Edit;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchListProject extends Component
{
    public $event;

    public $projectname = '';

    public $added = false;

    public function mount($event)
    {
        $this->event = $event;
    }

    #[Computed]
    public function searchList()
    {
        $addedProjectIds = $this->event->projects->pluck('id');

        return $this->projectname
            ? auth()->user()->projects()
                ->where('name', 'like', '%'.$this->projectname.'%')
                ->whereNotIn('id', $addedProjectIds)
                ->orderBy('name')
                ->get()
            : new Collection();
    }

    public function addProject($projectId)
    {
        $project = auth()->user()->projects()->findOrFail($projectId);

        if (! $this->event->projects()->where('project_id', $project->id)->exists()) {
            auth()->user()->projectPonderations()->create([
                'event_id' => $this->event->id,
                'project_id' => $projectId,
                'ponderation1' => 1,
                'ponderation2' => 1,
            ]);
        }

        $this->dispatch('fetchEventProjects');

        $this->added = true;
    }

    public function render()
    {
        return view('livewire.events.edit.search-list-project');
    }
}
