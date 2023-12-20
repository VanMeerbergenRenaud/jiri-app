<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

        return view('livewire/events/show', compact('user', 'event'));
    }

    // Specific event edition / update
    public function editEdition($eventId)
    {
        $user = auth()->user();

        $event = Event::findOrFail($eventId);

        $students = $event->contacts()->get();

        return view('livewire/events/edit-edition', compact('user', 'event', 'students'));
    }

    public function updateEdition($eventId): RedirectResponse
    {
        $data = $this->validateEventData();

        $event = Event::findOrFail($eventId);

        $event->update($data);

        return redirect()->route('events.editEdition', compact('event'));
    }

    // Route d'un contact lié à une épreuve
    public function showContact($eventId, $contactId)
    {
        $user = auth()->user();

        $event = Event::findOrFail($eventId);

        $contact = $event->contacts()->findOrFail($contactId);

        return view('livewire/events/show-contact', compact('user', 'event', 'contact'));
    }
}
