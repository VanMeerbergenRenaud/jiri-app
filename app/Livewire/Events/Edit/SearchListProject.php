<?php

namespace App\Livewire\Events\Edit;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchListProject extends Component
{
    public $eventId;

    public $projectname = '';

    #[Computed]
    public function searchList()
    {
        $event = auth()->user()->events()->findOrFail($this->eventId);
        $addedProjectIds = $event->projects->pluck('id');

        return $this->projectname
            ? auth()->user()->projects()
            ->where('name', 'like', '%' . $this->projectname . '%')
            ->whereNotIn('id', $addedProjectIds)
            ->orderBy('name')
            ->get()
            : new Collection();
    }

    public function addProject($projectId)
    {
        $event = auth()->user()->events()->findOrFail($this->eventId);
        $project = auth()->user()->projects()->findOrFail($projectId);

        // Avoid duplicate projects in a event
        if ($event->projects->contains($project)) {
            return;
        }

        auth()->user()->eventProjects()->create([
            'event_id' => $event->id,
            'project_id' => $project->id,
            'ponderation1' => 1,
            'ponderation2' => 1,
            'link' => 'https://example.com',
        ]);

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.edit.search-list-project');
    }
}
