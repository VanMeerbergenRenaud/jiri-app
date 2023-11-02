<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Request;

class EventController extends Controller
{
    public function index(User $user)
    {
        $events = Event::orderBy('starting_at', 'asc')->get();
        return view('livewire.events-list', compact('events', 'user'));
    }

    public function create(User $user): View
    {
        return view('livewire.events/create', compact('user'));
    }

    public function show(User $user)
    {
        return view('livewire.events/show', compact('user'));
    }

    public function edit(User $user, $eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('livewire.events/edit', compact('user', 'event'));
    }

    public function store(): RedirectResponse
    {
        $data = $this->validateEventData();

        auth()->user()?->events()->create($data);

        return redirect('events');
    }

    public function update(User $user, $eventId): RedirectResponse
    {
        $data = $this->validateEventData();

        $event = Event::findOrFail($eventId);
        $event->update($data);

        return redirect()->route('events', compact('user', 'event'));
    }

    public function destroy()
    {
        // Supprimer l'événement
    }

    private function validateEventData()
    {
        return Request::validate([
            'name' => 'required',
            'starting_at' => 'required|date',
            'duration' => 'required|integer',
        ]);
    }
}
