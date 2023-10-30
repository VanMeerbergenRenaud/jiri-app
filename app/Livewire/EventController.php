<?php

namespace App\Livewire;

use Livewire\Component;

class EventController extends Component
{
    public function index()
    {
        /*$events = Event::all();*/
        return view('livewire.event-controller'/*, compact('events')*/);
    }

    public function create()
    {
        return view('livewire.events/create');
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
