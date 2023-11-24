<?php

namespace App\Livewire\Events\Create;

use App\Models\Project;
use Livewire\Component;

class FormProject extends Component
{
    public $projects;
    public $uniqueTasks;

    public function mount()
    {
        $this->projects = Project::all();
        $this->uniqueTasks = $this->getUniqueTasks();
    }

    public function getUniqueTasks()
    {
        return $this->projects->flatMap(function ($project) {
            return json_decode($project->tasks);
        })->unique();
    }

    public function render()
    {
        return view('livewire.events.create.form-project');
    }
}
