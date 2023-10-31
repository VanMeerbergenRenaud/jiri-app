<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class EventController extends Component
{
    public function index()
    {
        /*$events = Event::all();*/
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

    }

    public function edit(Event $event)
    {

    }

    public function update(Event $event)
    {
        // Update a single event
    }
}
