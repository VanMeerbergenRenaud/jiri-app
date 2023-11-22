<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Auth;
use Illuminate\Http\RedirectResponse;
use function Laravel\Prompts\alert;

class ContactsController
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        $contacts = $this->user->contacts()->whereIn('role', ['student', 'evaluator'])->get();

        $students = $contacts->where('role', 'student');
        $evaluators = $contacts->where('role', 'evaluator');

        return view('livewire.pages/contacts', ['user' => $this->user, 'contacts' => $contacts, 'students' => $students, 'evaluators' => $evaluators]);
    }

    public function create()
    {
        $contact = new Contact();

        return view('livewire/contacts/create', ['user' => $this->user, 'contact' => $contact]);
    }

    public function show($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        return view('livewire/contacts/show', compact('contact'));
    }

    public function edit($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        return view('livewire/contacts/edit', compact('contact'));
    }

    public function store(): RedirectResponse
    {
        $data = $this->validateContactData();

        auth()->user()?->contacts()->create($data);

        return redirect('contacts');
    }

    public function update($contactId): RedirectResponse
    {
        $data = $this->validateContactData();

        $contact = Contact::findOrFail($contactId);

        $contact->update($data);

        return redirect()->route('contacts.index', compact('contact'));
    }

    public function destroy($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        $contact->delete();

        return redirect()->route('contacts.index', compact('contact'));
    }

    private function validateContactData()
    {
        return request()->validate([
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:contacts,email',
        ]);
    }
}
