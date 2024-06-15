<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

// Permet de voir le résumé des évaluations
// sur tous les projets évalués par l'évaluateur
class Show extends Component
{
    public function render()
    {
        return view('livewire.evaluator.evaluations.show')
            ->layout('layouts.evaluator', ['title' => 'Résumé des évaluations']);
    }
}
