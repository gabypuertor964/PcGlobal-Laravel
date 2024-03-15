<?php

use App\Http\Controllers\Payments\PayPalCardController;
use Illuminate\Support\Facades\Route;

// Pago con PayPal JS (Card)
Route::get('/paypal/process/{orderId}', [PayPalCardController::class, 'process'])->name('paypal.process');