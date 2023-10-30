<?php

use App\Http\Controllers\JiriController;

Route::middleware('auth')->group(function () {
    Route::get('/jiris', [JiriController::class, 'index']);
});
