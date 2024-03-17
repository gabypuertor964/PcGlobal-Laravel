<?php

use App\Http\Controllers\admin\deliveryController;
use App\Http\Controllers\admin\FacturationController;
use App\Http\Controllers\admin\inventory\BrandsController;
use App\Http\Controllers\admin\inventory\CategoriesController;
use App\Http\Controllers\admin\inventory\ProductsController;
use App\Http\Controllers\admin\PqrsController;
use App\Http\Controllers\admin\WorkersController;
use Illuminate\Support\Facades\Route;

// Usuarios Autorizados: Personal Administrativo
Route::middleware(['auth'])->group(function () {

    /* Modulo PQRS */
    Route::middleware(['can:pqrs.read'])->group(function () {

        // Consultar Las respuestas del usuario autenticado
        Route::get('/pqrs/my_responses', [PqrsController::class, 'myResponses'])->name('admin.pqrs.my_responses');

        // Ver PQRS activas (Sin responder)
        Route::get('/pqrs/active', [PqrsController::class, 'active'])->name('admin.pqrs.active');

        // Leer, Mostrar, editar y actualizar PQRS
        Route::resource('/pqrs', PqrsController::class)->names('admin.pqrs')->except(["create","store","destroy"]);

    });

    /* Modulo Facturacion */
    Route::controller(FacturationController::class)->group(function(){

        // Listar facturas
        Route::get('/facturation', 'index')->name('admin.facturation.index');

        // Listar facturas pendientes por entregar
        Route::get('/facturation/active', 'active')->name('admin.facturation.active');

        // Ver factura
        Route::get('/facturation/{slug}', 'show')->name('admin.facturation.show');

        // Buscar Entregas segun numero de documento del cliente
        Route::get('/facturation/search', 'search')->name('admin.facturation.search');

    })->middleware('can:gerency.read');

    /* Modulo Inventario */
    Route::middleware('can:inventory.read')->group(function () {
        
        // CRUD Marcas
        Route::resource('/brands', BrandsController::class)->names('inventory.brands');

        // CRUD Categorias
        Route::resource('/categories', CategoriesController::class)->names('inventory.categories');

        // CRUD Productos
        Route::resource('/products', ProductsController::class)->names('inventory.products');

    })->prefix('inventory');

    /* Modulo Entregas */
    Route::middleware(['can:delivery.read'])->group(function () {

        // Listar, Ver, Editar y Actualizar Entregas
        Route::resource('/delivery', deliveryController::class)->names('admin.delivery')->except(["create","store","destroy","show"]);
    });

    /* Modulo Trabajadores */
    Route::resource('/workers', WorkersController::class)->names('admin.workers')->middleware('can:gerency.read')->except('show');
});