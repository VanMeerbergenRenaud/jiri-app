<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowContactProfil extends Component
{
    use WithFileUploads;

    public $contact;

    public $contactType;

    public $projects;

    public $tasks;

    public $globalComment;

    public ContactForm $form;

    public $showEditDialog = false;

    public function save()
    {
        $this->form->update();

        $this->contact->refresh();

        $this->reset('showEditDialog');
    }

    public function mount($contact)
    {
        $this->contact = $contact;
        $this->form->setContact($this->contact);

        $this->contactType = auth()->user()->attendances()
            ->where('contact_id', $contact->id)
            ->where('event_id', $this->contact->pivot->event_id)
            ->first()
            ->role;

        // Fetch projects related to the event with duties
        $this->projects = auth()->user()->eventProjects()
            ->where('event_id', $this->contact->pivot->event_id)
            ->get();

        $this->globalComment = 'À changer';
    }

    public function render()
    {
        return view('livewire.contacts.show-contact-profil');
    }
}
