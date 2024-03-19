<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\clients\FacturationController;
use App\Http\Controllers\landingPageController;
use App\Http\Controllers\Payments\PayPalCardController;
use App\Models\SaleInvoice;
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

    // Buscador de productos
    Route::post('search', 'searchProduct')->name("search.products");
});


/**
 * Rutas shopping cart
 */
Route::controller(CartController::class)->group(function(){

    // Vista:Carrito de compras
    Route::get("cart", "checkout")->name("cart.checkout");

    // Añadir producto al carrito
    Route::post("cart/add", "add")->name("cart.add");

    // Actualizar producto al carrito
    Route::post("cart/update", "update")->name("cart.update");

    // Eliminar producto del carrito
    Route::post("cart/remove", "remove")->name("cart.remove");

    // Vaciar el carrito
    Route::get("cart/clear", "clear")->name("cart.clear");

    // Vaciar el carrito
    Route::get("cart/clearAfterPurchase", "clearAfterPurchase")->name("cart.clear.after.purchase");

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


/**
 * Ruta de compra
*/
Route::get('/paypal/process/{orderId}', [PayPalCardController::class, 'process'])->name('paypal.process');


// Prueba

Route::get('popo', function() {
    $facturation = SaleInvoice::find(4);
    $facturation->datetime = FacturationController::getDateTimeInArray($facturation->date_sale);
    $facturation->tax_percentage = FacturationController::getTaxPercentage($facturation);

    return view('mail.facturation.create_invoice', ['facturation' => $facturation]);
});