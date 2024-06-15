<?php

namespace App\Livewire\Evaluator;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.evaluator.dashboard')
            ->layout('layouts.evaluator', ['title' => 'Tableau de bord principal']);
    }
}
