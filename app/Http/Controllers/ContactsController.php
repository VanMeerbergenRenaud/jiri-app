<?php

namespace App\Http\Controllers;

use Auth;

class ContactsController
{
    public function index()
    {
        $user = Auth::user();
        return view('livewire.contacts', compact('user'));
    }
}
