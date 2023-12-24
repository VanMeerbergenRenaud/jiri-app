<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attendance;
use Illuminate\Http\Request;

class EvaluatorController extends Controller
{
    public function index(Event $event)
    {
        $evaluator = auth()->user()->attendances()->where('role', 'evaluator')->first();
        return view('pages/evaluator.index', compact('event', 'evaluator'));
    }

    /*public function show(Event $event, $token)
    {
        $evaluator = Attendance::where('event_id', $event->id)
            ->where('token', $token)
            ->where('role', 'evaluator')
            ->firstOrFail();

        return view('evaluator.show', compact('event', 'evaluator'));
    }*/
}
