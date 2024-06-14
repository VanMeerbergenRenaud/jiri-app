<?php

namespace App\Livewire\Evaluator;

use Livewire\Component;

class DashboardSummary extends Component
{
    public function render()
    {
        return view('livewire.evaluator.dashboard-summary')
            ->layout('layouts.evaluator', ['title' => 'Summary']);
    }
}
