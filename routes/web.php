<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Contacts\ContactProfil as EContactProfil;
use App\Livewire\Contacts\Index as CIndex;
use App\Livewire\Contacts\Show as CShow;
use App\Livewire\Dashboard;
use App\Livewire\Evaluator\Dashboard as EEvaluatorDashboard;
use App\Livewire\Evaluator\Evaluations\Edit as EEvaluatorEvaluationEdit;
use App\Livewire\Evaluator\Evaluations\Index as EEvaluatorEvaluationIndex;
use App\Livewire\Evaluator\Evaluations\Show as EEvaluatorEvaluationShow;
use App\Livewire\Evaluator\EventDashboard as EEvaluatorEventDashboard;
use App\Livewire\Events\Edit as EEdit;
use App\Livewire\Events\Event\Evaluators as EEvaluators;
use App\Livewire\Events\Event\Projects as EProjects;
use App\Livewire\Events\Event\Students as EStudents;
use App\Livewire\Events\Index as EIndex;
use App\Livewire\Events\Show as EShow;
use App\Livewire\Homepage;
use App\Livewire\Projects\Index as PIndex;
use App\Livewire\Projects\Show as PShow;
use App\Livewire\Welcome;
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

/*----- Homepage guest user -----*/
Route::get('/home', Homepage::class)
    ->middleware('guest')
    ->name('homepage');

/*----- Homepage authenticated user -----*/
Route::get('/welcome', Welcome::class)
    ->middleware(['auth', 'verified'])
    ->name('welcome');

Route::middleware('auth')->group(function () {
    /*----- Admin dashboard -----*/
    Route::get('/', Dashboard::class)->name('dashboard');

    /*----- Profile CRUD -----*/
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*----- Events CRUD -----*/
    Route::name('events.')->prefix('events')->group(function () {
        Route::get('/', EIndex::class)->name('index');
        Route::get('/{event}', EShow::class)->name('show');
        Route::get('/{event}/edit', EEdit::class)->name('edit');

        /*----- Contact -----*/
        // Contact profil data in a specific event
        Route::get('/{event}/contacts/{contact}', EContactProfil::class)
            ->name('contact-profil');

        /*----- Admin event dashboard -----*/
        // Route for the dashboard of an event with all the data
        Route::get('/{event}/evaluators', EEvaluators::class)
            ->name('event.dashboard.evaluators');

        // Route for the dashboard of an event with all the contacts
        Route::get('/{event}/students', EStudents::class)
            ->name('event.dashboard.students');

        // Route for the dashboard of an event with all the projects
        Route::get('/{event}/projects', EProjects::class)
            ->name('event.dashboard.projects');

        /*----- Evaluator dashboard -----*/
        // Route for the dashboard of an evaluator with all the events
        Route::get('/evaluator/{contact}', EEvaluatorDashboard::class)
            ->name('evaluator-dashboard');

        /*----- Evaluator event dashboard -----*/
        // Route for the specific event of an evaluator
        Route::get('/{event}/{contact}/{token}', EEvaluatorEventDashboard::class)
            ->middleware('evaluator')
            ->name('evaluator-dashboard-event');

        // Route that let the evaluator start an evaluation
        Route::get('/{event}/{contact}/{token}/evaluation-start/{student}', EEvaluatorEvaluationIndex::class)
            ->middleware('evaluator')
            ->name('evaluator-evaluation-start');

        // Route that let the evaluator start an evaluation
        Route::get('/{event}/{contact}/{token}/evaluation-edit/{student}/{project}', EEvaluatorEvaluationEdit::class)
            ->middleware('evaluator')
            ->name('evaluator-evaluation-edit');

        // Route that let the evaluator see the summary of the evaluations
        Route::get('/{event}/{contact}/{token}/evaluation-summary/{student}', EEvaluatorEvaluationShow::class)
            ->middleware('evaluator')
            ->name('evaluator-evaluation-summary');
    });

    /*----- Students CRUD -----*/
    Route::name('contacts.')->prefix('contacts')->group(function () {
        Route::get('/', CIndex::class)->name('index');
        Route::get('/{contact}', CShow::class)->name('show');
    });

    /*----- Projects CRUD -----*/
    Route::name('projects.')->prefix('projects')->group(function () {
        Route::get('/', PIndex::class)->name('index');
        Route::get('/{project}', PShow::class)->name('show');
    });
});

require __DIR__.'/auth.php';
