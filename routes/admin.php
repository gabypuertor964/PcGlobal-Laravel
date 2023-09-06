<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\landingPageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    /* Rutas Modulo PQRS */
        Route::get('/reservations', function () {
            
        })->name("PQ");
    //

    /* Rutas Modulo Ventas */

    //
});