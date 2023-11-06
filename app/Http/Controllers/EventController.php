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

        $eventGroups = $events->groupBy(fn($event) => $event->eventStatus());

        return view('livewire.events-list', compact('user', 'events', 'eventGroups'));
    }

    public function create(): View
    {
        $user = Auth::user();
        return view('livewire.events/create', compact('user'));
    }

    public function show($eventId)
    {
        $user = Auth::user();
        $event = Event::findOrFail($eventId);
        return view('livewire.events/show', compact('user', 'event'));
    }

    public function edit($eventId)
    {
        $user = Auth::user();
        $event = Event::findOrFail($eventId);
        return view('livewire.events/edit', compact('user', 'event'));
    }

    public function store(): RedirectResponse
    {
        $data = $this->validateEventData();

        auth()->user()?->events()->create($data);

        return redirect('events');
    }

    public function update($eventId): RedirectResponse
    {
        $data = $this->validateEventData();

        $event = Event::findOrFail($eventId);

        $event->update($data);

        return redirect()->route('events', compact('event'));
    }

    public function destroy($eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->delete();

        return redirect()->route('events');
    }

    private function validateEventData()
    {
        return request()->validate([
            'name' => 'required',
            'starting_at' => 'required|date',
            'duration' => 'required|integer',
        ]);
    }
}