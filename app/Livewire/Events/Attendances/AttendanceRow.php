<?php

namespace App\Livewire\Events\Attendances;

use App\Livewire\Forms\AttendanceForm;
use App\Livewire\Forms\ContactForm;
use Livewire\Component;

class AttendanceRow extends Component
{
    public $attendance;

    public AttendanceForm $attendanceForm;
    public ContactForm $contactForm;

    public $showEditDialog = false;

    public function mount()
    {
        $this->contactForm->setContact($this->attendance->contact);
        $this->attendanceForm->setAttendance($this->attendance);
    }

    public function save()
    {
        $this->attendanceForm->update();

        $this->attendanceForm->refresh();

        $this->reset('showEditDialog');
    }

    public function render()
    {
        return view('livewire.events.attendances.attendance-row');
    }
}
