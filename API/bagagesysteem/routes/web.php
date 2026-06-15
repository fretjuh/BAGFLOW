<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/dashboard', function () {
    $gates = \App\Models\Gate::all();
    return view('dashboard', compact('gates'));
})->name('dashboard');

require __DIR__.'/auth.php';
