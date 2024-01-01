<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController
{
    public function index()
    {
        $user = auth()->user();

        return view('dashboard', compact('user'));
    }
}
