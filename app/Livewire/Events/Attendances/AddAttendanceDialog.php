<?php

namespace App\Livewire\Events\Attendances;

use App\Livewire\Forms\AttendanceForm;
use App\Livewire\Forms\ContactForm;
use Livewire\Component;

class AddAttendanceDialog extends Component
{
    public ContactForm $contactForm;
    public AttendanceForm $attendanceForm;

    public $show = false;

    public $added = false;

    public function add()
    {
        $this->contactForm->save();
        $this->attendanceForm->save();

        $this->reset('show');

        $this->added = true;
    }

    public function render()
    {
        return view('livewire.events.attendances.add-attendance-dialog');
    }
}
