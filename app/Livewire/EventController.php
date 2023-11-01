<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\Event;
use Livewire\Component;

class EventController extends Component
{
    public function index(Event $event, User $user)
    {
        return view('livewire.events-list', compact('user'));
    }

    public function create(Event $event, User $user)
    {
        return view('livewire.events/create', compact('user'));
    }

    public function show(Event $event, User $user)
    {
        return view('livewire.events/show', compact('user'));
    }

    public function edit(Event $event, User $user)
    {
        return view('livewire.events/edit', compact('user'));
    }

    public function store(Event $event, $request)
    {
        /*
        $this->validate([
            // Event fields
        ]);

        Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'Épreuve créée avec succès.');
        */
    }

    public function update(Event $event, $request)
    {
        /*
        $this->validate([
            // Event fields
        ]);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Épreuve mise à jour avec succès.');
        */
    }

    public function destroy(Event $event, $request)
    {
        /*
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Épreuve supprimée avec succès.');
        */
    }
}
