<?php

use App\Http\Controllers\admin\deliveryController;
use App\Http\Controllers\admin\facturationController;
use App\Http\Controllers\admin\inventory\BrandsController;
use App\Http\Controllers\admin\inventory\CategoriesController;
use App\Http\Controllers\admin\inventory\ProductsController;
use App\Http\Controllers\admin\PqrsController;
use App\Http\Controllers\admin\WorkersController;
use Illuminate\Support\Facades\Route;

// Usuarios Autorizados: Personal Administrativo
Route::middleware(['auth'])->group(function () {

    //Vista: Dashboard 
    Route::get('/dashboard', function () {
        return view("admin.dashboard");
    })->name("admin.dashboard");

    /*
        Modulo: PQRS
        Roles Autorizados:

            1. Atencion al Cliente (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::resource('/pqrs', PqrsController::class)->names('admin.pqrs')->middleware('can:pqrs.read');

    /*
        Modulo: Facturation
        Roles Autorizados:

            1. Vendedor (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::resource('/facturation', facturationController::class)->names('admin.facturation')->middleware('can:facturation.read');

    /*
        Modulo: Inventory/Inventario
        Roles Autorizados:

            1. Almacenista (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::middleware('can:inventory.read')->group(function () {
        
        //CRUD Marcas
        Route::resource('/brands', BrandsController::class)->names('inventory.brands')->except('show');

        //CRUD Categorias
        Route::resource('/categories', CategoriesController::class)->names('inventory.categories');

        //CRUD Productos
        Route::resource('/products', ProductsController::class)->names('inventory.products');

    })->prefix('inventory');

    /*
        Modulo: Delivery
        Roles Autorizados:

            1. Repartidor (Todos los Permisos)
            2. Gerente (Solo Lectura)
        --
    */
    Route::resource('/delivery', deliveryController::class)->names('admin.delivery')->middleware('can:delivery.read')->except('delete');

    /*
        Modulo: Admin
        Roles Autorizados:

            1. Gerente (Todos los Permisos)
        --
    */
    Route::resource('/workers', WorkersController::class)->names('admin.workers')->middleware('can:gerency.read');
});