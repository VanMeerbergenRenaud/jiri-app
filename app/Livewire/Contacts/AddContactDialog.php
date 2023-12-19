<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;

class AddContactDialog extends Component
{
    public ContactForm $form;

    public $show = false;

    public $added = false;

    public function add()
    {
        $this->form->save();

        $this->reset('show');

        $this->added = true;

        $this->dispatch('added');
    }

    public function render()
    {
        return view('livewire.contacts.add-contact-dialog');
    }
}
