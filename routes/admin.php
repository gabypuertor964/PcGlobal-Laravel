<?php

use App\Http\Controllers\admin\deliveryController;
use App\Http\Controllers\admin\facturationController;
use App\Http\Controllers\admin\gerencyController;
use App\Http\Controllers\admin\inventoryController;
use App\Http\Controllers\admin\pqrsController;
use Illuminate\Support\Facades\Route;

// Usuarios Autorizados: Personal Administrativo
Route::middleware(['auth'])->group(function () {

    //Vista: Dashboard 
    Route::get('/', function () {
        return view("admin.dashboard");
    })->name("admin.dashboard");

    Route::get('/pqrs', function () {
        return "a";
    });

    /*
        Modulo: PQRS
        Roles Autorizados:

            1. Atencion al Cliente (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::resource('/pqrs', pqrsController::class)->names('admin.pqrs')->middleware('can:pqrs.read');

    /*
        Modulo: Facturation
        Roles Autorizados:

            1. Vendedor (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::resource('/facturation', facturationController::class)->names('admin.facturation')->middleware('can:facturation.read');

    /*
        Modulo: Inventory
        Roles Autorizados:

            1. Almacenista (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::resource('/inventory', inventoryController::class)->names('admin.inventory')->middleware('can:inventory.read');

    /*
        Modulo: Delivery
        Roles Autorizados:

            1. Repartidor (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::resource('/delivery', deliveryController::class)->names('admin.delivery')->middleware('can:delivery.read');

    /*
        Modulo: Admin
        Roles Autorizados:

            1. Gerente (Todos los Permisos)
        --
    */
    Route::resource('/gerency', gerencyController::class)->names('admin.gerency')->middleware('can:gerency.read');
});