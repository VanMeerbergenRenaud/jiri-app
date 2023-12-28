<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContactRow extends Component
{
    use WithFileUploads;

    public $contact;

    public ContactForm $form;

    public $showEditDialog = false;

    public function mount()
    {
        $this->form->setContact($this->contact);
    }

    public function save()
    {
        $this->form->update();

        $this->contact->refresh();

        $this->reset('showEditDialog');
    }

    public function render()
    {
        return view('livewire.contacts.contact-row');
    }
}
