<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\WelcomeController;
use App\Livewire\ImageUpload;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Homepage */
Route::get('/', [HomepageController::class, 'index'])
    ->middleware('guest')
    ->name('homepage');

/* Homepage authenticated user */
Route::get('/welcome', [WelcomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('welcome');

Route::middleware('auth')->group(function () {
    /* Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Profile RUD */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* Events CRUD */
    Route::resource('events', EventController::class);

    /* Contacts CRUD */
    Route::resource('contacts', ContactsController::class);

    /* Projects CRUD */
    Route::resource('projects', ProjectsController::class);

    // Evaluator dashboard
    Route::get('/events/{event}/evaluator/{evaluator}/{token}', [EventController::class, 'showEvaluator'])->name('events.showEvaluator');

    // Route of a specific contact in a specific event
    Route::get('/events/{event}/contacts/{contact}', [EventController::class, 'showContact'])->name('events.showContact');
});

require __DIR__.'/auth.php';
require __DIR__.'/pages.php';
