<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

// Permet de voir la page pour évaluer
// le projet d'un étudiant pour l'évaluateur
class Index extends Component
{
    public $event;

    public $contact;

    public $token;

    public $projects;

    public function mount()
    {
        $this->event = auth()->user()->events()->findOrFail(request()->event);
        $this->contact = auth()->user()->contacts()->findOrFail(request()->contact);
        $this->token = request()->token;
        $this->projects = $this->event->projects;
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.index')
            ->layout('layouts.evaluator');
    }
}
