<?php

namespace App\Livewire\Projects;

use Livewire\Component;

class Show extends Component
{
    public $projectId;

    public function mount($project)
    {
        $this->projectId = $project;
    }

    public function render()
    {
        $user = auth()->user();

        $project = $user->projects()->findOrFail($this->projectId);

        return view('livewire.projects.show', compact('user', 'project'))
            ->layout('layouts.app');
    }
}
