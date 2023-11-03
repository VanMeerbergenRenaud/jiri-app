<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);
        return view('dashboard', compact('user'));
    }
}
