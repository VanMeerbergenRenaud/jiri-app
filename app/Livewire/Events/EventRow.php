<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use App\Mail\EvaluatorInvitation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EventRow extends Component
{
    public $event;

    public EventForm $form;

    public $showEditDialog = false;

    public $saved = false;

    public function mount($event)
    {
        $this->event = $event;

        $this->form->setEvent($this->event);
    }

    public function formatDate($date)
    {
        Carbon::setLocale('fr');

        return Carbon::parse($date)->translatedFormat('d/m/y à H'.':'.'i');
    }

    public function formatTime($time)
    {
        Carbon::setLocale('fr');
        $time = Carbon::parse($time);
        $hours = ltrim($time->format('H'), '0');
        $minutes = $time->format('i');

        if ($hours > 0) {
            return $hours.'h'.$minutes.'min';
        } else {
            return $minutes.'min';
        }
    }

    public function save()
    {
        $this->form->update();
        $this->reset('showEditDialog');
        $this->saved = true;

        return redirect()->route('events.index');
    }

    public function startEvent()
    {
        $contacts = $this->event->eventContacts()
            ->get();

        $evaluators = $this->event->eventContacts()
            ->where('role', 'evaluator')
            ->get();

        $projects = $this->event->projectPonderations()
            ->get();

        // If there are no participants, show an error message
        if ($contacts->isEmpty()) {
            session()->flash('errorParticipants', 'Attention, il n\'y a aucun participant enregistré à cet événement, veuillez en ajouter avant de démarrer l\'épreuve.');

            return false;
        }

        // If there are no evaluators, show an error message
        if ($evaluators->isEmpty()) {
            session()->flash('errorNoEvaluator', 'Attention, il n\'y a aucun évaluateur enregistré à cet événement, veuillez en ajouter avant de démarrer l\'épreuve.');

            return false;
        }

        // If there are evaluators without an email, show an error message
        $evaluatorNamesWithoutEmail = [];

        foreach ($evaluators as $evaluator) {
            if (empty($evaluator->contact->email)) {
                $evaluatorNamesWithoutEmail[] = $evaluator->contact->name;
            }
        }

        if (! empty($evaluatorNamesWithoutEmail)) {
            $names = implode(', ', $evaluatorNamesWithoutEmail);
            session()->flash('errorEvaluatorEmail', 'Attention, les évaluateurs suivants n\'ont pas d\'email enregistré. Ils ne recevront pas de lien pour accéder à leur tableau de bord de l\'épreuve. Veuillez ajouter un email à : '.ucfirst($names).'.');

            return false;
        }

        // If there are no projects
        if ($projects->isEmpty()) {
            session()->flash('errorNoProject', 'Attention, il n\'y a aucun projet enregistré à cet événement, veuillez en ajouter avant de démarrer l\'épreuve.');

            return false;
        }

        // After error validation, we can start the event in two steps:
        // 1. Send an email to all the evaluator's participants
        foreach ($evaluators as $evaluator) {
            $contactId = $evaluator->contact->id;
            $email = $evaluator->contact->email;
            $token = $evaluator->token;

            if ($evaluator) {
                if (! empty($email)) {
                    Mail::to($email)->send(new EvaluatorInvitation($this->event->id, $contactId, $token));
                }
            }

            // 2. Add a time to the started_at column
            $this->event->update([
                'started_at' => now(),
            ]);
        }

        return redirect()->route('events.show', $this->event->id);
    }

    public function render()
    {
        return view('livewire.events.event-row');
    }
}
