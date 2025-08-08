<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProximityAlertController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/proximity-form', function () {
    return view('dashboard.form');
})->name('proximity.form');

Route::post('/check-proximity', [ProximityAlertController::class, 'checkProximity'])->name('check.proximity');

Route::get('/logs', [ProximityAlertController::class, 'showLogs'])->name('logs.index');

