<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddContactDialog extends Component
{
    use WithFileUploads;
    
    public ContactForm $form;

    public $show = false;

    public $added = false;

    public function add()
    {
        $this->form->save();

        $this->reset('show');

        $this->added = true;
    }

    public function render()
    {
        return view('livewire.contacts.add-contact-dialog');
    }
}
