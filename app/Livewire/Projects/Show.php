<?php

namespace App\Livewire\Projects;

use Livewire\Component;

class Show extends Component
{
    public $projectId;

    public $projects;

    public function mount($project)
    {
        $this->projectId = $project;
        $this->projects = auth()->user()->projects;
    }

    public function redirectUser($projectId)
    {
        return redirect()->route('projects.show', ['project' => $projectId]);
    }

    public function render()
    {
        $project = auth()->user()->projects->find($this->projectId);

        return view('livewire.projects.show', compact('project'))
            ->layout('layouts.app');
    }
}
