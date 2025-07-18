<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsightController;

Route::get('/', function () {
    return view('index');
});

// Test routes removed for production

// Direct web route for insight generation (backup for API route)
Route::post('/generate-insight-web', [InsightController::class, 'generate']);
