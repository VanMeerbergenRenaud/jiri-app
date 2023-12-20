<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEvents extends Component
{
    use WithPagination;

    public $events;

    public $pastEvents;
    public $currentEvents;
    public $futureEvents;

    public $search = '';
    public $saved = false;

    public function mount()
    {
        $this->updateEvents();
    }

    public function updatedSearch()
    {
        $this->updateEvents();
    }

    public function delete($eventId)
    {
        $event = Event::findOrFail($eventId);

        foreach ($event->duties as $duty) {
            $duty->implementations()->delete();
        }

        $event->attendances()->delete();
        $event->duties()->delete();
        $event->delete();

        sleep(1);

        $this->saved = true;

        $this->updateEvents();
    }

    public function render()
    {
        return view('livewire.events.show-events', [
            'events' => $this->events,
            'saved' => $this->saved,
        ]);
    }

    private function updateEvents()
    {
        $this->events = auth()->user()->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->get();

        $this->futureEvents = $this->events->filter(fn ($event) => $event->isUpcoming());
        $this->pastEvents = $this->events->filter(fn ($event) => $event->isPast());
        $this->currentEvents = $this->events->filter(fn ($event) => $event->isCurrent());
    }
}
