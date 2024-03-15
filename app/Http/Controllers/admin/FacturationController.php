<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class FacturationController extends Controller
{
    /**
     * @abstract Metodo constructor y declaracion de middlewares
    */
    public function __construct(){
        $this->middleware('can: gerency.read')->only('index','show');
    }

    /**
     * @abstract Consultar y mostrar la lista de facturas
     */
    public function index()
    {
        return view("clients.dashboard");
    }

    /**
     * @abstract Ver la informacion detallada de una factura
     */
    public function show(string $slug)
    {
        return view("clients.dashboard");
    }
}
