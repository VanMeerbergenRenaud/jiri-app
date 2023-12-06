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

    public $newprojecttasks = [];

    public $newprojecttask;

    public function mount()
    {
        $this->projects = Project::all();
        // Tasks from the tasks Table
        $this->tasks = User::find(auth()->id())->tasks;
    }

    public function save(): void
    {
        $this->validate();

        $user = auth()->user();

        $user->projects()->create([
            'name' => $this->newprojectname,
            'description' => 'Some description',
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
