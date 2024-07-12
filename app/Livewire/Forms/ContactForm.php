<?php

namespace App\Livewire\Forms;

use App\Models\Contact;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    #[Validate('required|min:3')]
    public string $name = '';

    #[Validate('required|min:3')]
    public string $firstname = '';

    #[Validate('nullable|email')]
    public $email = null;

    public $avatar = null;

    public Contact $contact;

    public function setContact($contact)
    {
        $this->contact = $contact;
        $this->name = $contact->name;
        $this->firstname = $contact->firstname;
        $this->email = $contact->email;
        $this->avatar = $contact->avatar;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'firstname' => 'required|min:3',
            'email' => [
                'nullable',
                'email',
            ],
        ];

        if (isset($this->contact->id)) {
            $rules['email'][] = Rule::unique('contacts')->ignore($this->contact->id);
        }

        return $rules;
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
        $this->validate($this->rules());

        $updateData = [
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
        ];

        if ($this->avatar instanceof UploadedFile) {
            $updateData['avatar'] = $this->storeFile($this->avatar) ?? $this->contact->avatar;
        }

        $this->contact->update($updateData);
    }

    protected function storeFile(?UploadedFile $file = null)
    {
        if (is_null($file)) {
            return null;
        }

        try {
            if (! $file->isValid()) {
                throw new \Exception('File upload error: '.$file->getErrorMessage());
            }

            // Generate a unique filename
            $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();

            // Store the file in the `avatars` folder
            $file->storeAs('avatars', $filename);

            // Return the file path
            return '/avatars/'.$filename;
        } catch (\Exception $e) {
            $this->addError('avatar', $e->getMessage());

            return null;
        }
    }
}
