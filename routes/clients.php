<?php

use App\Http\Controllers\landingPageController;
use Illuminate\Support\Facades\Route;

/*
    Nombre Archivo: clients.php

    Manifiesto Vistas:

        Modulo PQRS:
            1.
        --

        Modulo Ventas:
            1.
        --

        Auth
            1. Dashboard
            2. Info-Perfil
        --
    --
*/

// Usuarios Autorizados: Clientes
Route::middleware(['auth', 'role:cliente'])->group(function () {

    //Vista: Dashboard 
    Route::get('/dashboard', function () {
        return view("clients.dashboard");
    })->name("clients.dashboard");

});
