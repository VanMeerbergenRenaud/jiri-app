<?php

namespace App\Livewire\Projects;

use Livewire\Component;

class Index extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = auth()->user()->projects;
    }

    public function render()
    {
        return view('livewire.projects.index')
            ->layout('layouts.app');
    }
}
