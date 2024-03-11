<?php

use App\Http\Controllers\clients\deliveryController;
use App\Http\Controllers\clients\FacturationController;
use App\Http\Controllers\clients\pqrsController;
use Illuminate\Support\Facades\Route;

// Usuarios Autorizados: Clientes
Route::middleware(['auth', 'role:cliente'])->group(function () {

    //Vista: Dashboard 
    Route::get('/', function () {
        return view("clients.dashboard");
    })->name("clients.dashboard");

    //Funcionalidad PQRS
    Route::resource('/pqrs', pqrsController::class)->names('clients.pqrs');

    //Funcionalidad Facturation
    Route::resource('/facturation', FacturationController::class)->names('clients.facturation');
});
