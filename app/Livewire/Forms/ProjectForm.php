<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectForm extends Form
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:3|max:255')]
    public $description = '';

    #[Validate('nullable')]
    public $selectedTasks = [];

    public Project $project;

    public function setProject($project)
    {
        $this->project = $project;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->selectedTasks = $project->selectedTasks;
    }

    public function save()
    {
        $this->validate();

        // Create a new project
        $project = auth()->user()->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
            'selectedTasks' => $this->selectedTasks,
        ]);

        $this->reset(['name', 'description', 'selectedTasks']);
    }

    public function update()
    {
        $this->validate();

        $this->project->update([
            'name' => $this->name,
            'description' => $this->description,
            'selectedTasks' => $this->selectedTasks,
        ]);
    }
}

