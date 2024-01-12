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

    #[Validate('required|min:3|max:255|nullable')]
    public $description = '';

    #[Validate('nullable')]
    public $selectedTasks = [];

    #[Validate('min:2|nullable')]
    public $newTask = '';

    public Project $project;

    public function setProject($project)
    {
        $this->project = $project;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->selectedTasks = $project->selectedTasks;
        $this->newTask = $project->newTask;
    }

    public function save()
    {
        $this->validate();

        // Create a new project
        $project = auth()->user()->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        // If newTask is not empty, create a new task
        if (!empty($this->newTask)) {
            $task = new Task();
            $task->name = $this->newTask;
            $task->project_id = $project->id;
            $task->user_id = auth()->user()->id;
            $task->save();
        }

        // Add selected tasks to all the tasks related to a project
        if (!empty($this->selectedTasks)) {
            foreach ($this->selectedTasks as $selectedTask) {
                $selectedTask->project_id = $project->id;
                $selectedTask->user_id = auth()->user()->id;
                $selectedTask->save();
            }
        }

        $this->reset(['name', 'description', 'selectedTasks', 'newTask']);
    }

    public function update()
    {
        $this->validate();

        $this->project->update([
            'name' => $this->name,
            'description' => $this->description,
            'selectedTasks' => $this->selectedTasks,
            'newTask' => $this->newTask,
        ]);
    }
}

