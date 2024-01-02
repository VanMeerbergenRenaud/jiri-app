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

        $event = $user->events()->findOrFail($eventId);

        return view('pages/events/show', compact('user', 'event'));
    }

    public function edit($eventId)
    {
        $user = auth()->user();

        $event = $user->events()->findOrFail($eventId);

        return view('pages/events/edit', compact('user', 'event'));
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
