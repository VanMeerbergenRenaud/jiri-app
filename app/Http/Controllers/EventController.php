<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use App\Notifications\EvaluatorInvitation;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $events = $user->events()->get();

        return view('pages/events', compact('user', 'events'));
    }

    public function show($eventId)
    {
        $user = auth()->user();

        $event = Event::findOrFail($eventId);

        return view('pages/events/show', compact('user', 'event'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Création de l'événement...
        $event = $user->create($request->all());

        // Création des évaluateurs...
        foreach ($request->input('evaluators') as $evaluatorData) {
            $evaluator = $user->attendances()->create($evaluatorData + ['event_id' => $event->id]);

            // Envoi de la notification à l'évaluateur
            $evaluator->notify(new EvaluatorInvitation($event, $evaluator->token));
        }

        return redirect()->route('events.show', $event);
    }

    // Specific event edition / update
    public function editEdition($eventId)
    {
        $user = auth()->user();

        $event = $user->events()->findOrFail($eventId);

        $students = $event->contacts()->get();

        return view('pages/events/edit-edition', compact('user', 'event', 'students'));
    }

    public function updateEdition($eventId): RedirectResponse
    {
        $data = $this->validateEventData();

        $event = auth()->user()->events()->findOrFail($eventId);

        $event->update($data);

        return redirect()->route('events.editEdition', compact('event'));
    }

    // Route d'un contact lié à une épreuve
    public function showContact($eventId, $contactId)
    {
        $user = auth()->user();

        $event = $user->events()->findOrFail($eventId);

        $contact = $event->contacts()->findOrFail($contactId);

        return view('pages/events/show-contact', compact('user', 'event', 'contact'));
    }

    // Route pour évaluateur spécifique
    public function showEvaluator($eventId, $contactId, $token)
    {
        $user = auth()->user();

        $event = $user->events()->findOrFail($eventId);

        $contact = $event->contacts()->findOrFail($contactId);

        $evaluator = $user->attendances()
            ->where('event_id', $eventId)
            ->where('token', $token)
            ->firstOrFail();

        return view('pages/events/show-evaluator', compact('user', 'event', 'contact', 'evaluator'));
    }
}
