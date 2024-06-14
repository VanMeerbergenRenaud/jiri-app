<?php

namespace App\Livewire\Evaluator;

use Livewire\Component;

class DashboardEvents extends Component
{
    public function render()
    {
        return view('livewire.evaluator.dashboard-events')
            ->layout('layouts.evaluator', ['title' => 'Dashboard for all the events']);
    }
}
