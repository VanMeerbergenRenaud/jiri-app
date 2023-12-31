<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class ShowContactProfil extends Component
{
    public $contact;

    public $contactType;

    public $projects;

    public $tasks;

    public function mount($contact)
    {
        $this->contact = $contact;

        $this->contactType = auth()->user()->attendances()
            ->where('contact_id', $contact->id)
            ->where('event_id', $this->contact->pivot->event_id)
            ->first()
            ->role;

        // Fetch projects related to the event with duties
        $this->projects = auth()->user()->duties()
            ->where('event_id', $this->contact->pivot->event_id)
            ->get();

        // Fetch tasks related to the project
        $this->tasks = auth()->user()->tasks()
            ->where('project_id', $this->projects->first()->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.contacts.show-contact-profil');
    }
}
