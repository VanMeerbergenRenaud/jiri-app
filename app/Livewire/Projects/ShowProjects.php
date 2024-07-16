<?php

namespace App\Livewire\Projects;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProjects extends Component
{
    use WithPagination;

    public $search = '';
    public $deleted = false;

    #[Computed]
    public function projectFilter()
    {
        return auth()->user()->projects()
            ->search('name', $this->search)
            ->orderBy('name')
            ->paginate(8);
    }

    public function delete($projectId)
    {
        $project = auth()->user()->projects()->findOrFail($projectId);

        $project->tasks()->delete();
        $project->projectPonderations()->delete();
        $project->delete();

        sleep(1);

        $this->deleted = true;
    }

    public function render()
    {
        return view('livewire.projects.show-projects');
    }
}
