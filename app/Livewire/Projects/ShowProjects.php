<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProjects extends Component
{
    use WithPagination;

    public $search = '';

    public $saved = false;

    public $tasks = [];

    public function mount()
    {
        $this->tasks = auth()->user()->projects()->with('tasks')->get();
    }

    #[Computed]
    public function projectFilter()
    {
        return auth()->user()->projects()
            ->search('name', $this->search)
            ->orderBy('name', 'asc')
            ->paginate(8);
    }

    public function delete($projectId)
    {
        $project = Project::findOrFail($projectId);

        // Delete the associated duties and their implementations
        foreach ($project->duties as $duty) {
            $duty->implementations()->delete();
            $duty->delete();
        }

        $project->events()->detach();
        $project->tasks()->delete();
        $project->delete();

        sleep(1);

        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.projects.show-projects', [
            'tasks' => $this->tasks,
        ]);
    }
}
