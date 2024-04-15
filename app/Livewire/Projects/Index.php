<?php

namespace App\Livewire\Projects;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $user = auth()->user();

        $projects = $user->projects()->get();

        return view('livewire.projects.index', compact('user', 'projects'))
            ->layout('layouts.app');
    }
}
