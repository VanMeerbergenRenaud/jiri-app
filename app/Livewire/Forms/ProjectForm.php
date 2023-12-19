<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Form;
use App\Models\Project;
use Livewire\Attributes\Validate;

class ProjectForm extends Form
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:3|max:255|nullable')]
    public $description = '';

    public $tasks = [];
    public $newTask = '';

    public Project $project;
    public Task $task;

    public function setProject($project)
    {
        $this->project = $project;
        $this->name = $project->name;
        $this->description = $project->description;

        $this->tasks = $project->tasks;
        $this->newTask = $project->newTask;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
            'tasks' => $this->tasks,
            'newTask' => $this->newTask,
        ]);

        $this->reset(['name', 'description', 'newTask']);
    }

    public function update()
    {
        $this->validate();

        $this->project->update([
            'name' => $this->name,
            'description' => $this->description,
            'tasks' => $this->tasks,
            'newTask' => $this->newTask,
        ]);
    }
}
