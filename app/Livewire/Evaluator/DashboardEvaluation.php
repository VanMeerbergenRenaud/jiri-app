<?php

namespace App\Livewire\Evaluator;

use Livewire\Component;
use App\Models\Event;
use App\Models\Contact;

class DashboardEvaluation extends Component
{
    public $contactId;

    public function mount($contact)
    {
        $this->contactId = $contact;
    }

    public function render()
    {
        $contact = auth()->user()->contacts()->findOrFail($this->contactId);
        return view('livewire.evaluator.dashboard-evaluation', compact('contact'))
            ->layout('layouts.evaluator', ['title' => 'Evaluation']);
    }
}
