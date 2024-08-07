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
        $this->event->refresh();
        $this->reset('showEditDialog');
    }

    public function startEvent()
    {
        $evaluators = $this->event->eventContacts()
            ->where('role', 'evaluator')
            ->get();

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
