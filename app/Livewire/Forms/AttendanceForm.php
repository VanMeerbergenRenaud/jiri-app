<?php

namespace App\Livewire\Forms;

use App\Models\Attendance;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AttendanceForm extends Form
{
    public Attendance $attendance;

    #[Validate('required|min:3')]
    public $role = '';

    #[Validate('required|min:3')]
    public $token = '';

    public function setAttendance($attendance)
    {
        $this->attendance = $attendance;
        $this->role = $attendance->role;
        $this->token = $attendance->token;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->attendances()->create([
            'role' => $this->role,
            'token' => $this->token,
        ]);

        $this->reset(['role', 'token']);
    }

    public function update()
    {
        $this->validate();

        $this->attendance->update([
            'role' => $this->role,
            'token' => $this->token,
        ]);
    }
}
