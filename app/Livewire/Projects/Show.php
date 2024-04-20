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
        $user = auth()->user();

        $project = $user->projects()->findOrFail($this->projectId);

        return view('livewire.projects.show', compact('user', 'project'))
            ->layout('layouts.app');
    }
}
