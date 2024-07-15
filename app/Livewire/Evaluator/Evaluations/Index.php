<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

// Permet de voir la page pour évaluer le projet d'un étudiant pour l'évaluateur
class Index extends Component
{
    public $event;
    public $evaluator;
    public $token;

    public $student;
    public $projects;

    public function mount($event, $contact, $token, $student)
    {
        $this->event = auth()->user()->events()->findOrFail($event);
        $this->evaluator = auth()->user()->contacts()->findOrFail($contact);
        $this->token = $token;
        $this->student = $this->event->contacts()->findOrFail($student);

        $this->projects = $this->event->projects;
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.index')
            ->layout('layouts.evaluator');
    }
}
