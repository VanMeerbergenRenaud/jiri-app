<?php

namespace App\Livewire\Events\Edit;

use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormProject extends Component
{
    public $user;

    public $tasks;

    public $projects;

    public int $eventId;

    #[Validate('required|min:3')]
    public $newprojectname;

    #[Validate('required|min:2')]
    public $newprojecttask;

    public $newprojecttasks = [];

    public function mount()
    {
        $this->user = auth()->user();

        $this->projects = $this->user->projects()->get();

        $this->tasks = auth()->user()->tasks()->get();
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
        return view('livewire.events.edit.form-project');
    }
}
