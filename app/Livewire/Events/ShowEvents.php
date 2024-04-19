<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowEvents extends Component
{
    use WithPagination;

    public $events;
    public $event;

    public $search = '';

    public $saved = false;

    #[Computed]
    public function pastEvents()
    {
        return auth()->user()->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('starting_at', '<', now()) /* Now - duration */
            ->orderBy('starting_at')
            ->paginate(4, pageName: 'past-page');
    }

    #[Computed]
    public function currentEvents()
    {
        foreach (auth()->user()->events as $event) {
            $starting_at = Carbon::parse($event->starting_at);
            $duration = Carbon::parse($event->duration);
            $ending_at = $starting_at->addHours($duration->hour)->addMinutes($duration->minute)->addSeconds($duration->second);

            if ($event->starting_at < now() && $ending_at > now()) {
                return auth()->user()->events()
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->whereBetween('starting_at', [$event->starting_at, $ending_at])
                    ->orderBy('starting_at')
                    ->paginate(4, pageName: 'current-page');
            }
        }

        return auth()->user()->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('starting_at', '=', now())
            ->orderBy('starting_at')
            ->paginate(4, pageName: 'current-page');
    }


    #[Computed]
    public function futureEvents()
    {
        return auth()->user()->events()
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('starting_at', '>', now())
            ->orderBy('starting_at')
            ->paginate(4, pageName: 'future-page');
    }

    public function delete($eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->attendances()->delete();
        $event->eventProjects()->delete();

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
