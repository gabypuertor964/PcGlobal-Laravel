<?php

namespace App\Http\Controllers;

use App\Http\Requests\authValidate;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{

    # Renderizacion vista registro de cliente
    public function registerView(){

        //Consultar tipos de documento
        $document_types = DocumentType::all();

        //Consultar sexos
        $sexes = Gender::all();

        //Retornar vista de registro enviando los datos requeridos
        return view("auth.register", compact('document_types','sexes'));
    }

    # Redireccion a dashboard segun rol del usuario
    public function redirect(){

        //Obtener toda la información del usuario autenticado
        $info_usuario=User::find(Auth::user()->id);

        //Obtener todos los roles que tenga el usuario y seleccionar el primero
        $rol=$info_usuario->getRoleNames()[0];

        //Redireccion segun rol
        switch($rol){

            /* Redireccion Dashboard Cliente */
                case "cliente":
                    return redirect()->route("clients.dashboard");
                break;
            //

            /* Redirecciones panel Administrativo */
                case "gestor_pqrs":
                    return redirect()->route("admin.pqrs.index");
                break;

                case "almacenista":
                    return redirect()->route("admin.inventory.index");
                break;

                case "vendedor":
                    return redirect()->route("admin.facturation.index");
                break;

                case "repartidor":
                    return redirect()->route("admin.delivery.index");
                break;

                case "gerente":
                    return redirect()->route("admin.dashboard");
                break;
            //
        }
    }

    # Ejecucion del registro del cliente
    public function clientRegister(authValidate $request){

        //Creacion del usuario + Asignacion del rol (Cliente)
        User::create([
            'nombres'=>strtoupper($request->nombres),
            'apellidos'=>strtoupper($request->apellidos),
            'id_sexo'=>$request->id_sexo,
            'id_tip_doc'=>$request->id_tip_doc,
            'num_doc'=>$request->num_doc,
            'num_tel'=>$request->num_tel,
            'fecha_nacimiento'=>$request->fecha_nacimiento,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'id_estado'=>State::where('nombre','Activo')->first()->id
        ])->assignRole('cliente');

        //Redireccion al home
        return redirect()->route("index");
    }
}   