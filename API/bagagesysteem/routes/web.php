<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

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


Route::get('/login',
[LoginController::class,'show'])
->name('login');


Route::post('/login',
[LoginController::class,'login']);


Route::post('/logout',
[LoginController::class,'logout']);


Route::get('/dashboard',
[DashboardController::class,'index'])
->middleware('auth');
