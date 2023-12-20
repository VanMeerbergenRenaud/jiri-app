<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEvents extends Component
{
    use WithPagination;

    public $search = '';

    public $events;

    public $pastEvents;
    public $currentEvents;
    public $futureEvents;

    public $saved = false;

    public function mount()
    {
        $this->events = auth()->user()->events()->get();

        $this->futureEvents = $this->events->filter(fn ($event) => $event->isUpcoming());
        $this->pastEvents = $this->events->filter(fn ($event) => $event->isPast());
        $this->currentEvents = $this->events->filter(fn ($event) => $event->isCurrent());
    }

    public function updatedSearch()
    {
        $this->events = auth()->user()->events()->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function delete($eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->contacts()->detach();
        $event->delete();

        sleep(1);

        $this->saved = true;

        $this->events = auth()->user()->events()->get();
    }

    public function render()
    {
        return view('livewire.events.show-events', [
            'events' => $this->events,
            'saved' => $this->saved,
        ]);
    }
}
