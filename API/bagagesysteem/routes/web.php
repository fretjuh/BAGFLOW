<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index');

require __DIR__.'/auth.php';


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/settings', function () {
    return view('settings');
});
