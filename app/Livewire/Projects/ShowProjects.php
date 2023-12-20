<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class ShowProjects extends Component
{
    public $search = '';

    public $projects;
    public $tasks = [];

    public function mount()
    {
        $this->projects = auth()->user()->projects()->get();
        $this->tasks = auth()->user()->projects()->with('tasks')->get();
    }

    public function updatedSearch()
    {
        $this->projects = auth()->user()->projects()->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function delete($projectId)
    {
        $project = Project::findOrFail($projectId);

        // Delete the associated duties and their implementations
        foreach ($project->duties as $duty) {
            $duty->implementations()->delete();
            $duty->delete();
        }

        // Delete the project even if it's associated to an event and or tasks
        $project->events()->detach();
        $project->tasks()->delete();
        $project->delete();

        session()->flash('success');

        sleep(1);

        $this->projects = auth()->user()->projects()->get();
    }

    public function render()
    {
        return view('livewire.projects.show-projects', [
            'projects' => $this->projects,
            'tasks' => $this->tasks,
        ]);
    }
}
