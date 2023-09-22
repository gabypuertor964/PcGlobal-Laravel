<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\landingPageController;
use App\Http\Controllers\productoController;
use Illuminate\Support\Facades\Route;

/*
    Manifiesto:

        Landing Page:
            1. Home
            2. Categorias
        --

        Auth:
            1. Registro
            2. Ruta de redireccion
            3. Login (Ruta proporcionada por Fortify)
        --
    --
*/

/*
    Nota: A causa de que la Landing Page requiere informacion actualizada de la BD para su funcionamiento se empleara un controlador dedicado a la misma
*/
    Route::controller(landingPageController::class)->group(function(){
        //Vista: Home
        Route::get('/', 'index')->name('index');

        //Seccion: Listado de categorias
        Route::get('/#categorias', 'index')->name('categorias');

        // Vista: Categorias productos
        Route::get('categorias/{category}', 'categoryDetail')->name('category.show');

        Route::get('productos/{product}','productDetail')->name('product.show');
    });
//

//Rutas de Autenticacion para usuarios que no hayan iniciado sesion (guest)
    Route::middleware(['guest'])->group(function () {

        //Consultar/Solicitar vista de registro de clientes
        Route::get('/register', [authController::class,'registerView'])->name('registerView');

        //Enviar datos del formulario de registro al controlador correspondiente
        Route::post('/register', [authController::class,'clientRegister'])->name("clientRegister");
    });
//

//Rutas accesibles unicamente por usuarios logueados (auth)
    Route::middleware(['auth'])->group(function () {

        //Ruta encaqrgada de realizar la redireccion al dashboard correspondiente segun el rol del usuario
        Route::get('/redirect',[authController::class,'redirect'])->name('redirect');
    });
//