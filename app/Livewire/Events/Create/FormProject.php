<?php

namespace App\Livewire\Events\Create;

use App\Models\Project;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FormProject extends Component
{
    public $tasks;
    public $projects;

    public int $eventId;

    #[Rule('required')]
    public $newprojectname;

    #[Rule('required')]
    public $newprojecttasks;

    public $newprojecttask;

    public function mount()
    {
        $this->projects = Project::all();
        $this->tasks = $this->getUniqueTasks();
    }

    public function getUniqueTasks()
    {
        return $this->projects->flatMap(function ($project) {
            return json_decode($project->tasks);
        })->unique();
    }

    public function save(): void
    {
        $this->validate();

        $renaud = User::whereEmail('renaud.vmb@gmail.com')->firstOrFail();

        $renaud->projects()->create([
            'name' => $this->newprojectname,
            'description' => 'coucou',
            'tasks' => $this->newprojecttasks,
            'task' => $this->newprojecttask,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.events.create.form-project');
    }
}