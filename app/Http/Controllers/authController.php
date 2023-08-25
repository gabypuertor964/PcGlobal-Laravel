<?php

namespace App\Http\Controllers;

use App\Http\Requests\authValidate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    /*
        Nombre Metodo: registerView

        Objetivo: Emplear los procedimientos almacenados y consultar aquellos datos requeridos por la vista de registro, para luego realiza la respectiva redirección
    */
    public function registerView(){

        //Consultar tipos de documento
        $tipos_documento=DB::select("CALL PA_consultar_tipos_documento()");

        //Consultar sexos
        $sexos=DB::select("CALL PA_consultar_sexos()");

        //Retornar vista de registro enviando los datos requeridos
        return view("auth.register",[
            'tipos_documento'=>$tipos_documento,
            'sexos'=>$sexos
        ]);
    }

    /*
        Nombre Metodo: redirect

        Objetivo: Validar el rol del usuario y realizar su respectiva redirección al dashboard correspondiente
    */
    public function redirect(){

        //Obtener toda la información del usuario autenticado
        $info_usuario=User::find(Auth::user()->id);

        //Obtener todos los roles que tenga el usuario y seleccionar el primero
        $rol=$info_usuario->getRoleNames()[0];

        /*
            Explicación: Según el rol recuperado, se realizará la respectiva redirección a su dashboard correspondiente

            Nota: A causa de que el personal administrativo empleara siempre el mismo dashboard, se agrupan sus case, para que evitar repetir codigo innecesario
        */
        switch($rol){
            case "gerente":

            break;

            case "coordinador_inventario":

            break;

            case "analista_inventario":

            break;

            case "servicio_cliente":

            break;

            case "cliente":
                return redirect()->route("clients.dashboard");
            break;
        }

    }

    /*
        Nombre Metodo: clientRegister

        Objetivo: Realizar el registro del cliente empleando el registro almacenado correspondiente
    */
    public function clientRegister(authValidate $request){

        /* Guardado informacion del formulario en variables */
            $nombres=strtoupper($request->nombres);
            $apellidos=strtoupper($request->apellidos);
            $id_sexo=$request->id_sexo;
            $id_tip_doc=$request->id_tip_doc;
            $num_doc=$request->num_doc;
            $num_tel=$request->num_tel;
            $fecha_nacimiento=$request->fecha_nacimiento;
            $email=$request->email;
            $password=Hash::make($request->password);
        //

        //Obtener la fecha y Hora actuales
        $datetime=date("Y-m-d H:i:s");

        //Ejecutar el Procedimiento con los datos ingresados
        DB::statement("CALL PA_registrar_usuario('$nombres','$apellidos','$id_sexo','$id_tip_doc','$num_doc','$num_tel','$fecha_nacimiento','$email','$password','$datetime')");

        //Consultar el Id del usuario recien creado
        $registro_usuario=DB::select('select id from users where nombres = ? AND apellidos = ?', [$nombres,$apellidos]);

        //Consultar la info del usuario recien creado, usando los metodos el metodo find para poder usar los metodos de Spatie
        $registro_usuario=User::find($registro_usuario[0]->id);

        //Asignacion del Rol al usuario
        $registro_usuario->assignRole('cliente');

        //Redireccion al home
        return redirect()->route("index");
    }
}   