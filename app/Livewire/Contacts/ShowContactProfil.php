<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowContactProfil extends Component
{
    use WithFileUploads;

    public $contact;
    public $projects;
    public $contactType;

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

        $this->contactType = auth()->user()->eventContacts()
            ->where('event_id', $this->contact->pivot->event_id)
            ->where('contact_id', $contact->id)
            ->first()
            ->role;

        $this->projects = auth()->user()->eventProjects()
            ->where('event_id', $this->contact->pivot->event_id)
            ->get();

        $this->globalComment = 'À changer';
    }

    // TODO : Change the role of the contact by updating its role in the attendances table (evaluator or student)
    public function editContactRole($role)
    {

    }

    public function render()
    {
        return view('livewire.contacts.show-contact-profil');
    }
}
