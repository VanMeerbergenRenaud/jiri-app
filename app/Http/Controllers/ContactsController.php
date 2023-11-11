<?php

namespace App\Http\Controllers;

use Auth;

class ContactsController
{
    public function index()
    {
        $user = Auth::user();

        // Get the contacts that are students or evaluators
        $contacts = $user->contacts()->where('role', 'student')->orWhere('role', 'evaluator')->get();

        // Get the contacts that are students
        $students = $user->contacts()->where('role', 'student')->get();

        // Get the contacts that are evaluators
        $evaluators = $user->contacts()->where('role', 'evaluator')->get();

        return view('livewire.pages/contacts', compact('user', 'contacts', 'students', 'evaluators'));
    }
}
