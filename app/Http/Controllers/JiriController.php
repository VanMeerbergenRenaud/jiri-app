<?php

namespace App\Http\Controllers;

class JiriController extends Controller
{
    public function index()
    {
        $jiris = auth()->user()->jiris;

        return view('pages.jiris', compact('jiris'));
    }
}
