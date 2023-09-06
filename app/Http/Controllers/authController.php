<?php

namespace App\Http\Controllers;

use App\Http\Requests\authValidate;
use App\Models\estados;
use App\Models\sexos;
use App\Models\tipos_documento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{

    # Renderizacion vista registro de cliente
    public function registerView(){

        //Consultar tipos de documento
        $tipos_documento=tipos_documento::all();

        //Consultar sexos
        $sexos=sexos::all();

        //Retornar vista de registro enviando los datos requeridos
        return view("auth.register",[
            'tipos_documento'=>$tipos_documento,
            'sexos'=>$sexos
        ]);
    }

    # Redireccion a dashboard segun rol del usuario
    public function redirect(){

        //Obtener toda la información del usuario autenticado
        $info_usuario=User::find(Auth::user()->id);

        //Obtener todos los roles que tenga el usuario y seleccionar el primero
        $rol=$info_usuario->getRoleNames()[0];

        if($rol=="cliente"){
            return redirect()->route("clients.dashboard");

        }else{
            return redirect()->route("admin.dashboard");
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
            'id_estado'=>estados::where('nombre','Activo')->first()->id
        ])->assignRole('cliente');

        //Redireccion al home
        return redirect()->route("index");
    }
}   