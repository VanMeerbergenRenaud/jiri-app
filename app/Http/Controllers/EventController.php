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
        $user = Auth::user();

        $events = Event::orderBy('starting_at', 'asc')->get();

        $upcomingEvents = $events->filter(fn ($event) => $event->isUpcoming());
        $pastEvents = $events->filter(fn ($event) => $event->isPast());
        $currentEvents = $events->filter(fn ($event) => $event->isCurrent());

        return view('livewire.pages.events', compact('user', 'events', 'upcomingEvents', 'pastEvents', 'currentEvents'));
    }

    public function create(): View
    {
        $user = Auth::user();

        $contacts = $user->contacts()->get();
        $projects = $user->projects()->get();

        $event = new Event();

        return view('livewire/events/create', compact('user', 'contacts', 'projects', 'event'));
    }

    public function show($eventId)
    {
        $user = Auth::user();

        $event = Event::findOrFail($eventId);

        return view('livewire/events/show', compact('user', 'event'));
    }

    public function edit($eventId)
    {
        $user = Auth::user();

        $event = Event::findOrFail($eventId);

        $contacts = $user->contacts()->get();

        return view('livewire/events/edit', compact('user', 'event', 'contacts'));
    }

    public function store(): RedirectResponse
    {
        $data = $this->validateEventData();

        $event = auth()->user()?->events()->create($data);

        return redirect()->route('events.edit', ['event' => $event]);
    }

    public function update($eventId): RedirectResponse
    {
        $data = $this->validateEventData();

        $event = Event::findOrFail($eventId);

        $event->update($data);

        return redirect()->route('events.index', compact('event'));
    }

    public function destroy($eventId)
    {
        $event = Event::findOrFail($eventId);

        // Delete related contacts and projects
        $event->contacts()->detach();
        /*$event->projects()->detach();*/

        $event->delete();

        return redirect('events');
    }

    private function validateEventData()
    {
        return request()->validate([
            'name' => 'required',
            'starting_at' => 'required|date',
            'duration' => 'required|integer',
        ]);
    }

    // Specific event edition / update
    public function editEdition($eventId)
    {
        $user = Auth::user();

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
}
