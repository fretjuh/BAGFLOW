<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');

Route::view('/instellingen', 'instellingen')->name('instellingen');

require __DIR__.'/auth.php';
