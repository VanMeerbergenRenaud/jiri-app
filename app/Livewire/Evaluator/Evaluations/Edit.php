<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        return view('livewire.evaluator.evaluations.edit')
            ->layout('layouts.evaluator', ['title' => 'Évaluation']);
    }
}
