<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class deliveryController extends Controller
{
    /**
     * @abstract Constructor de la clase y middleware de permisos
    */
    public function __construct()
    {
        /**
         * Usuarios autorizados
         * 
         * Index (Listar) -> Repartidor, Gerente
         * Search (Buscar) -> Repartidor
         * Show (Ver) -> Gerente
         * Edit (Editar) -> Repartidor
         * Update (Actualizar) -> Repartidor
        */
        $this->middleware("can:gerency.read")->only(["index","show"]);

        $this->middleware("can:delivery.create")->only(["edit", "update","search"]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("clients.dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("clients.dashboard");
    }

    /**
     * @abstract Buscador de pedidos segun numero de documento
    */
    public function search()
    {
        return view("clients.dashboard");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("clients.dashboard");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
