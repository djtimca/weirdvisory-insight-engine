<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogTestController;

Route::get('/', function () {
    return view('index');
});

// Log testing route - remove in production
Route::get('/test-log', [LogTestController::class, 'testLog']);
