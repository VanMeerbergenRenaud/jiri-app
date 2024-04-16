<?php

namespace App\Livewire\Events\Edit;

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

    #[Validate('required|min:3|max:255')]
    public $newprojectdescription;

    #[Validate('nullable')]
    public $newprojecttasks;

    public function mount()
    {
        $this->user = auth()->user();

        $this->projects = $this->user->projects()->get();
    }

    public function save(): void
    {
        $this->validate();

        $project = $this->user->projects()->create([
            'name' => $this->newprojectname,
            'description' => $this->newprojectdescription,
            'tasks' => $this->newprojecttasks,
        ]);

        $this->projects->push($project);// Add the new project to the projects collection

        $this->reset();
    }

    public function render()
    {
        return view('livewire.events.edit.form-project');
    }
}
