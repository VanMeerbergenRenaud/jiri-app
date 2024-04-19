<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectForm extends Form
{
    #[Validate('required|min:3|max:255')]
    public $name = '';

    #[Validate('required|min:3|max:255')]
    public $description = '';

    #[Validate('nullable')]
    public $tasks = [""];

    public Project $project;

    public function setProject($project)
    {
        $this->project = $project;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->tasks = $project->tasks;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
            'tasks' => $this->tasks,
        ]);

        $this->reset(['name', 'description', 'tasks']);
    }

    public function update()
    {
        $this->validate();

        $this->project->update([
            'name' => $this->name,
            'description' => $this->description,
            'tasks' => $this->tasks,
        ]);
    }
}

