<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;

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

        return view('livewire/contacts/create', compact('contact'));
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
        $data = request()->validate([
            'name' => 'required',
            'firstname' => 'required',
        ]);

        $contact = Contact::findOrFail($contactId);

        $contact->update($data);

        return redirect('contacts');
    }

    public function destroy($contactId)
    {
        $contact = Contact::findOrFail($contactId);

        $contact->delete();

        return redirect('contacts');
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
