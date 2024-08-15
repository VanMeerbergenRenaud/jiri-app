<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContactRow extends Component
{
    use WithFileUploads;

    public $contact;

    public ContactForm $form;

    public $showEditDialog = false;

    public $saved = false;

    public function mount()
    {
        $this->form->setContact($this->contact);
    }

    public function saveContact()
    {
        $this->form->update();
        $this->contact->refresh();
        $this->reset('showEditDialog');
        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.contacts.contact-row');
    }
}
