<?php

namespace App\Livewire\Project\Edit;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Form extends Component
{
    public $project;

    #[Rule('required', 'min:3', 'newtask')]
    public $newtask;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function addTask()
    {
        $this->validate();

        $this->project->tasks()->create([
            'name' => $this->newtask,
            'project_id' => $this->project->id,
        ]);

        $this->reset();
    }

    public function deleteTask($taskId)
    {
        $task = $this->project->tasks()->find($taskId);
        $task->delete();
    }

    public function render()
    {
        return view('livewire.project.edit.form');
    }
}
