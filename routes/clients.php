<?php

use App\Http\Controllers\clients\FacturationController;
use App\Http\Controllers\clients\PqrsController;
use Illuminate\Support\Facades\Route;

// Usuarios Autorizados: Clientes
Route::middleware(['auth', 'role:cliente'])->group(function () {
    
    // Modulo PQRS
    Route::resource('/pqrs', PqrsController::class)->names('clients.pqrs');

    //Funcionalidad Facturation
    Route::resource('/facturation', FacturationController::class)->names('clients.facturation')->only(["index","show"]);
});
