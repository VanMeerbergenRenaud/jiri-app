<?php

namespace App\Livewire\Events\Configure;

use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FormProject extends Component
{
    public $user;

    public $tasks;

    public $projects;

    public int $eventId;

    #[Rule('required', 'min:2', 'name')]
    public $newprojectname;

    #[Rule('required', 'min:1', 'newtask')]
    public $newprojecttask;

    public $newprojecttasks = [];

    public function mount()
    {
        $this->user = auth()->user();

        $this->projects = $this->user->projects()->get();

        $this->tasks = Task::all();
    }

    public function save(): void
    {
        $this->validate();

        $project = $this->user->projects()->create([
            'name' => $this->newprojectname,
            'description' => 'Some description',
        ]);

        $project->tasks()->create([
            'name' => $this->newprojecttask,
            'project_id' => $project->id,
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.events.configure.form-project');
    }
}
