<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogTestController;
use App\Http\Controllers\InsightController;

Route::get('/', function () {
    return view('index');
});

// Log testing route - remove in production
Route::get('/test-log', [LogTestController::class, 'testLog']);

// Direct web route for insight generation (backup for API route)
Route::post('/generate-insight-web', [InsightController::class, 'generate']);
