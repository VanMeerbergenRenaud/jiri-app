<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEvents extends Component
{
    use WithPagination;

    public $events;

    public $search = '';

    public $saved = false;

    #[Computed]
    public function pastEvents()
    {
        return auth()->user()->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('starting_at', '<', now())
            ->orderBy('starting_at', 'asc')
            ->paginate(4, pageName: 'past-page');
    }

    #[Computed]
    public function currentEvents()
    {
        return auth()->user()->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->whereBetween('starting_at', [
                now(),
                now()->addHours(8)
            ])
            ->orderBy('starting_at', 'asc')
            ->paginate(4, pageName: 'current-page');
    }

    #[Computed]
    public function futureEvents()
    {
        return auth()->user()->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('starting_at', '>', now())
            ->orderBy('starting_at', 'asc')
            ->paginate(4, pageName: 'future-page');
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
    }

    public function render()
    {
        return view('livewire.events.show-events', [
            'saved' => $this->saved,
        ]);
    }
}
