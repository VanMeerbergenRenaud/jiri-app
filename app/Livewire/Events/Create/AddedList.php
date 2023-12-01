<?php

namespace App\Livewire\Events\Create;

use App\Models\Attendance;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedList extends Component
{
    public $eventId;

    public Collection $contactsList;

    public function mount()
    {
        $event = Event::find($this->eventId);
        $this->contactsList = $event->attendances;
    }

    #[On('fetchEventContacts')]
    public function fetchEventContacts()
    {
        $event = Event::find($this->eventId);

        $this->contactsList = $event->contacts;
    }

    public function removeContact($attendanceId)
    {
        $event = Event::find($this->eventId);

        $attendance = Attendance::find($attendanceId);

        if ($attendance) {
            $event->contacts()->detach($attendance->contact_id);
            $this->dispatch('fetchEventContacts');
        } else {
            dd('hello');
        }
    }

    public function render()
    {
        return view('livewire.events.create.added-list');
    }
}
