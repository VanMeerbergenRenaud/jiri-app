<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Homepage;
use App\Livewire\Welcome;
use App\Livewire\Dashboard;
use App\Livewire\Contacts\Index as CIndex;
use App\Livewire\Contacts\Show as CShow;
use App\Livewire\Contacts\ContactProfil as EContactProfil;
use App\Livewire\Events\Index as EIndex;
use App\Livewire\Events\Show as EShow;
use App\Livewire\Events\Edit as EEdit;
use App\Livewire\Events\EvaluatorDashboard as EEvaluatorDashboard;
use App\Livewire\Evaluator\DashboardEvaluation as EEvaluatorDashboardEvaluation;
use App\Livewire\Evaluator\DashboardSummary as EEvaluatorDashboardSummary;
use App\Livewire\Evaluator\DashboardEvents as EEvaluatorEventsDashboard;
use App\Livewire\Projects\Index as PIndex;
use App\Livewire\Projects\Show as PShow;
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
        // Route::get('/create', Create::class)->name('create');
        Route::get('/{event}', EShow::class)->name('show');
        Route::get('/{event}/edit', EEdit::class)->name('edit');

        /*----- Contact -----*/
        // Contact profil data in a specific event
        Route::get('/{event}/contacts/{contact}', EContactProfil::class)
            ->name('contact-profil');

        /*----- Evaluator -----*/
        // Route for the dashboard of an evaluator for a specific event
        Route::get('/{event}/contact/{contact}/{token}', EEvaluatorDashboard::class)
            ->name('evaluator-dashboard');

        // Route that let the evaluator start an evaluation
        Route::get('/{event}/contact/{contact}/{token}/evaluation', EEvaluatorDashboardEvaluation::class)
            ->name('evaluator-dashboard-evaluation');

        // Route that let the evaluator see the summary of the evaluation
        Route::get('/{event}/contact/{contact}/{token}/summary', EEvaluatorDashboardSummary::class)
            ->name('evaluator-dashboard-summary');
    });

    /*----- Contacts CRUD -----*/
    Route::name('contacts.')->prefix('contacts')->group(function () {
        Route::get('/', CIndex::class)->name('index');
        Route::get('/{contact}', CShow::class)->name('show');
    });

    /*----- Projects CRUD -----*/
    Route::name('projects.')->prefix('projects')->group(function () {
        Route::get('/', PIndex::class)->name('index');
        Route::get('/{project}', PShow::class)->name('show');
    });

    /*----- Evaluator dashboard -----*/
    // Route for all the events of an evaluator
    Route::get('events/contact/{contact}/{token}', EEvaluatorEventsDashboard::class)
      //->middleware('evaluator')
        ->name('evaluator-events-dashboard');
});

require __DIR__.'/auth.php';
require __DIR__.'/pages.php';
