<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pqrs;
use Illuminate\Http\Request;

class PqrsController extends Controller
{
    /**
     * @abstract Constructor de la clase y middleware de permisos
    */	
    public function __construct(){

        /**
         * Usuarios autorizados:
         * 
         * index (Listar) -> Gerente, Personal de PQRS
         * show (Ver) -> Gerente
         * active (Listar) -> Gerente, Personal de PQRS
         * myResponses (Listar) -> Personal de PQRS
         * edit (Editar) -> Personal de PQRS
         * update (Actualizar) -> Personal de PQRS
        */

        $this->middleware("can:gerency.read")->only(["show","active"]);

        $this->middleware('role:gestor_PQRS')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Listar todas las PQRS
        $pqrs = Pqrs::all();

        // Retornar la vista con el listado de PQRS
        return view("admin.pqrs.index");
    }

    /**
     * @abstract Retornar el listado de PQRS sin responder
    */
    public function active()
    {
        return "Jose";
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
     * @abstract Retornar el listado de PQRS respondidas por el usuario autenticado
    */
    public function myResponses()
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
