<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

// Permet de voir le résumé des évaluations
// sur tous les projets évalués par l'évaluateur
class Show extends Component
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
        return view('livewire.evaluator.evaluations.show')
            ->layout('layouts.evaluator');
    }
}
