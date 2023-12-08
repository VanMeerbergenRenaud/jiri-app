<?php

namespace App\Livewire\Project;

use Livewire\Component;

class Edit extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.project.edit');
    }
}
