<?php

namespace App\Livewire\Project\Edit;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Test extends Component
{
    public $project;

    #[Rule('required', 'min:3', 'max:255')]
    public $newtask;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function addTask($projectId)
    {
        $this->validate();

        $project = auth()->user()->projects()->find($projectId);

        // dd($project->tasks()->get());

        $project->tasks()->create([
            'name' => $this->newtask,
            'project_id' => $project->id,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.project.edit.test');
    }
}
