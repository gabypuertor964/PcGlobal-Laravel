<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;

class FacturationController extends Controller
{
    /**
     * @abstract Listar la lista de compras realizadas por el cliente
     */
    public function index()
    {
        return view("clients.dashboard");
    }

    /**
     * @abstract Mostrar la informacion de la factura seleccionada
     */
    public function show(string $id)
    {
        //
    }

}
