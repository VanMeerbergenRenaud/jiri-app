<?php

namespace App\Livewire\Events;

use Livewire\Component;
use Livewire\WithPagination;

class ShowEvents extends Component
{
    use WithPagination;

    public $events;

    public $search = '';

    public $deleted = false;

    public function mount($events)
    {
        $this->events = $events;
    }

    public function delete($eventId)
    {
        $event = auth()->user()->events()->findOrFail($eventId);

        $event->eventContacts()->delete();
        $event->projectPonderations()->delete();
        $event->delete();

        sleep(1);

        $this->deleted = true;
    }

    public function render()
    {
        $finishedEvents = auth()->user()->events()
            ->withCount('contacts', 'projects')
            ->where('finished_at', '!=', null)
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('starting_at')
            ->paginate(4, ['*'], 'finishedEvents');

        $availableEvents = auth()->user()->events()
            ->withCount('contacts', 'projects')
            ->where('starting_at', '<', now())
            ->where('started_at', '=', null)
            ->where('paused_at', '=', null)
            ->where('finished_at', '=', null)
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('starting_at')
            ->paginate(4, ['*'], 'availableEvents');

        $currentEvents = auth()->user()->events()
            ->withCount('contacts', 'projects')
            ->where('started_at', '!=', null)
            ->where('paused_at', '=', null)
            ->where('finished_at', '=', null)
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('starting_at')
            ->paginate(4, ['*'], 'currentEvents');

        $pausedEvents = auth()->user()->events()
            ->withCount('contacts', 'projects')
            ->where('started_at', '!=', null)
            ->where('paused_at', '!=', null)
            ->where('finished_at', '=', null)
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('starting_at')
            ->paginate(4, ['*'], 'pausedEvents');

        $comingSoonEvents = auth()->user()->events()
            ->withCount('contacts', 'projects')
            ->where('starting_at', '>', now())
            ->where('started_at', '=', null)
            ->where('paused_at', '=', null)
            ->where('finished_at', '=', null)
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('starting_at')
            ->paginate(4, ['*'], 'comingSoonEvents');

        return view('livewire.events.show-events', compact('finishedEvents', 'availableEvents', 'currentEvents', 'pausedEvents', 'comingSoonEvents'));
    }
}
