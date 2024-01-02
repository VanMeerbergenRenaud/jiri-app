<?php

namespace App\Livewire\Events\Edit;

use App\Models\Attendance;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class AddedList extends Component
{
    public $eventId;

    public Collection $attendanceList;

    public function mount()
    {
        $this->fetchEventContacts();
    }

    #[On('fetchEventContacts')]
    public function fetchEventContacts()
    {
        $event = Event::find($this->eventId);
        $this->attendanceList = $event->attendances;
    }

    public function removeContact(Attendance $attendance)
    {
        $attendance->delete();

        $this->dispatch('fetchEventContacts');
    }

    public function render()
    {
        return view('livewire.events.edit.added-list');
    }
}
