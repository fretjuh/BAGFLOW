<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BagageController;
use App\Http\Controllers\VluchtController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\GebruikerController;
use App\Http\Controllers\AuthController;

Route::prefix('v1')->group(function () {

    // Authenticatie
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Bagage
    Route::get('/bagage', [BagageController::class, 'index']);
    Route::get('/bagage/{rfid}', [BagageController::class, 'show']);
    Route::post('/bagage', [BagageController::class, 'store']);
    Route::patch('/bagage/{rfid}/status', [BagageController::class, 'updateStatus']);

    // Vluchten
    Route::get('/vluchten', [VluchtController::class, 'index']);
    Route::get('/vluchten/{id}', [VluchtController::class, 'show']);
    Route::post('/vluchten', [VluchtController::class, 'store']);
    Route::patch('/vluchten/{id}', [VluchtController::class, 'update']);

    // Zones
    Route::get('/zones', [ZoneController::class, 'index']);
    Route::get('/zones/{id}', [ZoneController::class, 'show']);
    Route::post('/zones', [ZoneController::class, 'store']);
    Route::patch('/zones/{id}/status', [ZoneController::class, 'updateStatus']);

    // Gebruikers
    Route::get('/gebruikers', [GebruikerController::class, 'index']);
    Route::post('/gebruikers', [GebruikerController::class, 'store']);

});