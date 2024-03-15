<?php

use App\Http\Controllers\clients\FacturationController;
use App\Http\Controllers\clients\pqrsController;
use Illuminate\Support\Facades\Route;

// Usuarios Autorizados: Clientes
Route::middleware(['auth', 'role:cliente'])->group(function () {
    
    // Modulo PQRS
    Route::resource('/pqrs', pqrsController::class)->names('clients.pqrs')->except("show");

    //Funcionalidad Facturation
    Route::resource('/facturation', FacturationController::class)->names('clients.facturation')->only(["index","show"]);
});
