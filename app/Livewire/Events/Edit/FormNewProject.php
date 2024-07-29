<?php

namespace App\Livewire\Events\Edit;

use Livewire\Attributes\Validate;
use Livewire\Component;

class FormNewProject extends Component
{
    public $event;

    public $newProject = false;

    #[Validate('required|min:2|max:50')]
    public $name = '';

    #[Validate('required|min:3|max:255')]
    public $description = '';

    #[Validate('nullable|url')]
    public $url_readme = '';

    public function mount($event)
    {
        $this->event = $event;
    }

    public function addProjectToEvent()
    {
        // Validate the form data
        $this->validate([
            'name' => 'required|min:2|max:50',
            'description' => 'required|min:3|max:255',
            'url_readme' => 'nullable|url',
        ]);

        // Create a new project
        $project = auth()->user()->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
            'url_readme' => $this->url_readme,
        ]);

        // Create a new ponderation project
        auth()->user()->projectPonderations()->create([
            'project_id' => $project->id,
            'event_id' => $this->event->id,
            'ponderation1' => 1,
            'ponderation2' => 1,
        ]);

        // Reset the form fields
        $this->reset(['name', 'description', 'url_readme']);

        $this->dispatch('fetchEventProjects');

        $this->newProject = true;
    }

    public function render()
    {
        return view('livewire.events.edit.form-new-project');
    }
}
