<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\landingPageController;
use App\Http\Controllers\productoController;
use Illuminate\Support\Facades\Route;

/*
    Nombre Archivo: web.php

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
    Nota: La landing page al requerir informacion actualizada de la base de datos, se emplea un controlador el cual realizara dichos procesos
*/
    Route::controller(landingPageController::class)->group(function(){
        //Vista: Home
        Route::get('/', 'index')->name('index');

        //Vista: Categorías landing
        Route::get('/#categorias', 'index')->name('categorias');

        // Vista: Categorias productos
        Route::get('categorias/{categoria}', 'categorias')->name('categoria');
    });
//

/*
    Rutas del producto seleccionado
*/
    Route::controller(productoController::class)->group(function(){
        Route::get('categorias/{categoria}/{producto}','show')->name('categoria.producto');
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

        //Ruta encaqrgada de realizar la redireccion al dashboard segun el rol del usuario
        Route::get('/redirect',[authController::class,'redirect']);
    });
//
