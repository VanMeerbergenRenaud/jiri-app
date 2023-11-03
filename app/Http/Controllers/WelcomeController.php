<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WelcomeController
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);
        return view('welcome', compact('user'));
    }
}
