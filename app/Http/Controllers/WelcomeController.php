<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController
{
    public function index()
    {
        $user = auth()->user();

        return view('welcome', compact('user'));
    }
}
