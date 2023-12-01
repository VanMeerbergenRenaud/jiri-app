<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);

        return view('dashboard', compact('user'));
    }
}
