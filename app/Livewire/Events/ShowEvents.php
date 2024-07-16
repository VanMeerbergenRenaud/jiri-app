<?php

namespace App\Livewire\Events;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEvents extends Component
{
    use WithPagination;

    public $events;

    public $search = '';

    public $deleted = false;

    private function getEvents($operator, $pageName)
    {
        return auth()->user()->events()
            ->where('name', 'like', '%'.$this->search.'%')
            ->where('starting_at', $operator, now())
            ->orderBy('starting_at')
            ->paginate(4, pageName: $pageName);
    }

    #[Computed]
    public function pastEvents()
    {
        return $this->getEvents('<', 'past-page');
    }

    #[Computed]
    public function currentEvents()
    {
        return $this->getEvents('=', 'current-page');
    }

    #[Computed]
    public function futureEvents()
    {
        return $this->getEvents('>', 'future-page');
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
        return view('livewire.events.show-events');
    }
}
