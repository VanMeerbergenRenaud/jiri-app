<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\EventController;
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

/* Home start page */
Route::get('/start', function () {
    return view('start-page');
})->name('start-page');

/* Home auth page */
Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    /* Welcome page */
    Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

    /* Profile CRUD */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* Events CRUD */
    Route::resource('events', EventController::class);

    /* Contacts CRUD */
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');

    /* Projects CRUD */
    Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
});

require __DIR__.'/auth.php';
require __DIR__.'/pages.php';
