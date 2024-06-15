<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

// Permet de voir la page pour évaluer
// le projet d'un étudiant pour l'évaluateur
class Index extends Component
{
    public function render()
    {
        $contact = auth()->user()->contacts()->findOrFail(request()->contact);

        return view('livewire.evaluator.evaluations.index', compact('contact'))
            ->layout('layouts.evaluator', ['title' => 'Evaluation en cours']);
    }
}
