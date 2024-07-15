<?php

namespace App\Livewire\Evaluator\Evaluations;

use Livewire\Component;

// Permet de voir la page pour évaluer le projet d'un étudiant pour l'évaluateur
class Index extends Component
{
    public $event;
    public $contact;
    public $token;

    public $projects = null;

    public function mount($event, $contact, $token)
    {
        $this->event = auth()->user()->events()
            ->findOrFail($event);

        $this->contact = $this->event->contacts()
            ->findOrFail($contact);

        $this->token = $token;

        $this->projects = $this->event->projects;
    }

    public function render()
    {
        return view('livewire.evaluator.evaluations.index')
            ->layout('layouts.evaluator');
    }
}
