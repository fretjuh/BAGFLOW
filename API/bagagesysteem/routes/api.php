<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BagageController;
use App\Http\Controllers\GateController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\VliegtuigController;
use App\Http\Controllers\VluchtschemaController;
use App\Http\Controllers\StatusBagageController;
use App\Http\Controllers\StatusMachineController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GebruikerController;

Route::prefix('v1')->group(function () {

    // Auth
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Bagage
    Route::get('/bagage', [BagageController::class, 'index']);
    Route::get('/bagage/{id}', [BagageController::class, 'show']);
    Route::post('/bagage', [BagageController::class, 'store']);
    Route::patch('/bagage/{id}/status', [BagageController::class, 'updateStatusBagage']);

    // Gates
    Route::get('/gates', [GateController::class, 'index']);
    Route::get('/gates/{id}', [GateController::class, 'show']);
    Route::post('/gates', [GateController::class, 'store']);
    Route::put('/gates/{gate}', [GateController::class, 'update']);

    // Machines
    Route::get('/machines', [MachineController::class, 'index']);
    Route::get('/machines/{id}', [MachineController::class, 'show']);
    Route::post('/machines', [MachineController::class, 'store']);
    Route::patch('/machines/{id}/status', [MachineController::class, 'updateStatus']);

    // Vliegtuigen
    Route::get('/vliegtuigen', [VliegtuigController::class, 'index']);
    Route::get('/vliegtuigen/{id}', [VliegtuigController::class, 'show']);
    Route::post('/vliegtuigen', [VliegtuigController::class, 'store']);

    // Vluchtschemas
    Route::get('/vluchtschemas', [VluchtschemaController::class, 'index']);
    Route::get('/vluchtschemas/{id}', [VluchtschemaController::class, 'show']);
    Route::post('/vluchtschemas', [VluchtschemaController::class, 'store']);
    Route::patch('/vluchtschemas/{id}', [VluchtschemaController::class, 'update']);

    // Statussen
    Route::get('/status-bagage', [StatusBagageController::class, 'index']);
    Route::get('/status-machine', [StatusMachineController::class, 'index']);

    // Gebruikers
    Route::get('/gebruikers', [GebruikerController::class, 'index']);
    Route::post('/gebruikers', [GebruikerController::class, 'store']);

});