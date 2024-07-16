<?php

namespace App\Livewire\Projects;

use Livewire\Component;

class Show extends Component
{
    public $project;
    public $projects;

    public function mount($project)
    {
        $this->projects = auth()->user()->projects;
        $this->project = auth()->user()->projects()->findOrFail($project);
    }

    public function redirectUser($projectId)
    {
        return redirect()->route('projects.show', ['project' => $projectId]);
    }

    public function render()
    {
        return view('livewire.projects.show')
            ->layout('layouts.app');
    }
}
