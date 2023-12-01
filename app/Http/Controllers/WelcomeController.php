<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);

        return view('welcome', compact('user'));
    }
}
