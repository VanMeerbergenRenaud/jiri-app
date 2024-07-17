<?php

namespace App\Livewire\Events\Edit;

use Livewire\Attributes\Validate;
use Livewire\Component;

class FormProject extends Component
{
    public $event;

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
        $this->validate();

        auth()->user()->projects()->create([
            'name' => $this->name,
            'description' => $this->description,
            'url_readme' => $this->url_readme,
        ]);

        $this->reset(['name', 'description', 'url_readme']);

        $this->dispatch('fetchEventProjects');
    }

    public function render()
    {
        return view('livewire.events.edit.form-project');
    }
}
