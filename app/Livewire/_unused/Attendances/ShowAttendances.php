<?php

namespace App\Livewire\_unused\Attendances;

use App\Models\Attendance;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAttendances extends Component
{
    use WithPagination;

    public $event;
    public $event_id;

    public $searchStudent = '';
    public $searchEvaluator = '';

    public $saved = false;

    public function mount()
    {
        $this->event_id = request()->route('event');
        $this->event = auth()->user()->events()->findOrFail($this->event_id);
    }

    #[Computed]
    public function attendanceFilterStudent()
    {
        return auth()->user()->attendances()
            ->where('event_id', $this->event->id)
            ->where('role', 'student')
            ->join('contacts', 'attendances.contact_id', '=', 'contacts.id')
            ->where('contacts.name', 'like', '%' . $this->searchStudent . '%')
            ->paginate(8);
    }

    #[Computed]
    public function attendanceFilterEvaluator()
    {
        return auth()->user()->attendances()
            ->where('event_id', $this->event->id)
            ->where('role', 'evaluator')
            ->join('contacts', 'attendances.contact_id', '=', 'contacts.id')
            ->where('contacts.name', 'like', '%' . $this->searchEvaluator . '%')
            ->paginate(8);
    }

    public function delete($attendanceId)
    {
        $attendance = Attendance::findOrFail($attendanceId);

        $attendance->delete();

        sleep(1);

        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.events.attendances.show-attendances', [
            'saved' => $this->saved,
        ]);
    }
}
