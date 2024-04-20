<?php

namespace App\Livewire\Projects;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $projects = auth()->user()->projects;

        return view('livewire.projects.index', compact('projects'))
            ->layout('layouts.app');
    }
}
