<?php
use Illuminate\Support\Facades\Route;

// Usuarios Autorizados: Personal Administrativo
Route::middleware(['auth'])->group(function () {

    //Vista: Dashboard 
    Route::get('/dashboard', function () {
        return view("admin.dashboard");
    })->name("admin.dashboard");
});