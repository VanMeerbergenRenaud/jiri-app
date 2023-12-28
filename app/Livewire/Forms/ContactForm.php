<?php

namespace App\Livewire\Forms;

use App\Models\Contact;
use Illuminate\Http\UploadedFile;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:3')]
    public $firstname = '';

    #[Validate('email|nullable')]
    public $email = null;

    public $avatar;

    public Contact $contact;

    public function setContact($contact)
    {
        $this->contact = $contact;
        $this->name = $contact->name;
        $this->firstname = $contact->firstname;
        $this->email = $contact->email;
        $this->avatar = $contact->avatar ?? null;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->contacts()->create([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
            'avatar' => $this->storeFile($this->avatar),
        ]);

        $this->reset(['name', 'firstname', 'email', 'avatar']);
    }

    public function update()
    {
        $this->validate();

        $this->contact->update([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
            'avatar' => $this->avatar ? $this->storeFile($this->avatar) : $this->contact->avatar,
        ]);
    }

    protected function storeFile(UploadedFile $file)
    {
        if ($file->isValid()) {
            // Generate a unique filename
            $filename = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();

            // Store the file in the `avatars` folder
            $file->storeAs('avatars', $filename);

            // Return the file path
            return 'http://jiri-app.test/public/avatars/' . $filename;
        } else {
            return 'Error uploading file';
        }
    }
}
