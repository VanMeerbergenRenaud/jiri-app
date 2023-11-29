<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class Edit extends Component
{
    public $tasks;

    public function mount()
    {
        $this->tasks = $this->getUniqueTasks();
    }

    public function getUniqueTasks()
    {
        return Project::all()->flatMap(function ($project) {
            return json_decode($project->tasks);
        })->unique();
    }

    public function render()
    {
        return view('livewire.project.edit');
    }
}
