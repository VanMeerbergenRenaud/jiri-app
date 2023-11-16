<?php

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('events', function () {
    return User::whereEmail('renaud.vmb@gmail.com')->firstOrFail();
});

Route::get('events/{event}', function (Event $event) {
    return $event->load('students', 'students.implementations.project', 'evaluators');
});
