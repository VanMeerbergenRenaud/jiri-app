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
        $eventContact = $contact->eventContacts()->first();

        // Fetch the event and token related to the contact
        $event = $eventContact->event;
        $token = $eventContact->token;

        return view('livewire.evaluator.evaluations.index', compact('contact', 'event', 'token'))
            ->layout('layouts.evaluator', ['title' => 'Evaluation en cours']);
    }
}
