<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/Dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

require __DIR__.'/auth.php';
