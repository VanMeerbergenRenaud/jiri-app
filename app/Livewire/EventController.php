<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class EventController extends Component
{
    public function index()
    {
        return view('livewire.events-list');
    }

    public function create()
    {
        $users = User::all();
        return view('livewire.events/create', ['users' => $users]);
    }

    public function store()
    {
        // Add logic to store a new event
    }

    public function show(Event $event)
    {
        return view('livewire.events/show');
    }

    public function edit(Event $event)
    {
        return view('livewire.events/edit');
    }

    public function update(Event $event)
    {
        /*$event->delete();
        return redirect()->route('events.index')->with('success', 'Événement supprimé avec succès.');*/
    }
}
