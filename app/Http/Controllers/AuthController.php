<?php

namespace App\Http\Controllers;

use App\Helpers\CleanInputs;
use App\Helpers\Validator;
use App\Http\Requests\ClientRequest;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\State;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @abstract Obtener los datos del usuario autenticado
     * 
     * @return \App\Models\User
     * 
    */
    public static function get()
    {
        try{
            return User::find(Auth::user()->id);
        }catch(Exception){
            return null;
        }
    }

    /**
     * @abstract Consultar y retornar la vista de registro junto con los datos requeridos
     * 
     * @return \Illuminate\View\View
    */
    public function registerView()
    {
        //Consultar tipos de documento
        $document_types = DocumentType::all();

        //Consultar sexos
        $genders = Gender::all();

        //Retornar vista de registro enviando los datos requeridos
        return view("auth.register", compact('document_types','genders'));
    }

    /**
     * @abstract Redireccionar al usuario segun su rol
     * 
     * @return \Illuminate\Http\RedirectResponse
    */
    public function redirect()
    {
        // Obtener la informacion del usuario autenticado
        $user = self::get();

        /**
         * En caso de no encontrar el usuario autenticado se redirecciona al logout
        */
        if($user == null){
            return redirect()->route('logout');
        }

        switch($user->getRoleNames()[0]){

            /* Redireccion Dashboard Cliente */
                case "cliente":
                    return redirect()->route("clients.dashboard");
                break;
            //

            /* Redireccion panel Administrativo */
                default:
                    return redirect()->route("admin.dashboard");
                break;
            //
        }
    }

    /**
     * @abstract Registro de cliente
     * 
     * @param \App\Http\Requests\ClientRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
    */
    public function clientRegister(ClientRequest $request)
    {
        try{

            /**
             * Ejecutar las validaciones adicionales
            */
            if(!Validator::runInRequest($request,User::inputs())){

                // Redireccion a la vista de registro con mensaje de advertencia
                return redirect()->back()->withInput()->with('message',[
                    'status'=>'warning',
                    'text'=>'¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            /**
             * Transaccion para la creacion de un cliente
             * 
             * @param ClientRequest $request
             * @return void
            */
            DB::transaction(function() use($request){
                User::create([
                    'names'=>CleanInputs::runUpper($request->names),
                    'surnames'=>CleanInputs::runUpper($request->surnames),
                    'gender_id'=>$request->gender_id,
                    'document_type_id'=>$request->document_type_id,
                    'document_number'=>$request->document_number,
                    'phone_number'=>$request->phone_number,
                    'date_birth'=>$request->date_birth,
                    'email'=>CleanInputs::runLower($request->email),
                    'password'=>Hash::make($request->password),
                ])->assignRole('cliente');
            });

            //Redireccion al login con mensaje de exito
            return redirect()->route("login")->with('message',[
                'status'=>'success',
                'text'=>'¡Registro exitoso!, por favor inicia sesión.'
            ]);

        }catch(Exception $e){

            //Redireccion a la vista de registro con mensaje de error
            return redirect()->back()->withInput()->with('message',[
                'status'=>'danger',
                'text'=>"'! Ha ocurrido un error, contacte al administrador del sistema. !'"
            ]);
        }
        
    }
}   