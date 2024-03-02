<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\landingPageController;
use Illuminate\Support\Facades\Route;

/**
 * Rutas landing page
*/
Route::controller(landingPageController::class)->group(function(){
    
    // Vista: Index/Principal
    Route::get('/', 'index')->name('index');

    // Vista: Listado de productos x categoria
    Route::get('categories/{category}', 'categoryDetail')->name('category.show');

    // Vista: Detallado de productos
    Route::get('products/{product}','productDetail')->name('product.show');
});

/**
 * Rutas shopping cart
 */
Route::controller(cartController::class)->group(function(){

    // Vista:Carrito de compras
    Route::get("cart", "checkout")->name("cart.checkout");

    // Añadir producto al carrito
    Route::post("cart/add", "add")->name("cart.add");

    // Eliminar producto del carrito
    Route::post("cart/remove", "remove")->name("cart.remove");

    // Vaciar el carrito
    Route::get("cart/clear", "clear")->name("cart.clear");
});

/**
 * Rutas de acceso para usuarios no autorizados
*/
Route::middleware(['guest'])->group(function () {

    // Registro de clientes
    Route::post('/register', [AuthController::class, 'clientRegister'])->name('client.register');
});

/**
 * Rutas de autenticacion (Unicamente para usuarios autenticados)
*/
Route::middleware(['auth'])->group(function () {

    // Redireccionamiento al dashboard correspondiente segun el rol
    Route::get('/redirect',[authController::class,'redirect'])->name('redirect');
});