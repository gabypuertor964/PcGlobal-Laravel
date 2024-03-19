<?php

namespace App\Http\Controllers\admin;

use App\Helpers\SlugManager;
use App\Helpers\Validator;
use App\Http\Controllers\Controller;
use App\Models\Pqrs;
use App\Http\Controllers\clients\PqrsController as ClientsPqrsController;
use App\Http\Requests\admin\PqrsRequest;
use App\Mail\pqrs\ResponsePqrsMail;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PqrsController extends Controller
{
    /**
     * @abstract Constructor de la clase y middleware de permisos
    */	
    public function __construct(){
        $this->middleware('role:gestor_PQRS')->only(["edit","update"]);
    }

    /**
     * @abstract Listar todas las PQRS
     */
    public function index()
    {
        // Listar todas las PQRS
        $pqrs_s = Pqrs::paginate(15);

        //Encriptar el slug
        foreach ($pqrs_s as $pqrs) {
            $pqrs->slug = SlugManager::encrypt($pqrs->id);
        }

        // Retornar la vista con el listado de PQRS
        return view("admin.pqrs.index", [
            "pqrs_s" => $pqrs_s,
            "title" => "Listado de PQRS"
        ]);
    }

    /**
     * @abstract Retornar el listado de PQRS sin responder
    */
    public function active()
    {
        // Listar todas las PQRS
        $pqrs_s = Pqrs::where("state_id", State::where("name","En espera")->first()->id)->paginate(15);

        //Encriptar el slug
        foreach ($pqrs_s as $pqrs) {
            $pqrs->slug = SlugManager::encrypt($pqrs->id);
        }

        // Retornar la vista con el listado de PQRS
        return view("admin.pqrs.index", [
            "pqrs_s" => $pqrs_s,
            "title" => "PQRS sin responder"
        ]);
    }

    /**
     * @abstract Ver la informacion de las PQRS.
    */
    public function show(string $slug)
    {
        // Obtener la PQRS
        $pqrs = ClientsPqrsController::get($slug);

        // Validar si la pqrs existe
        if($pqrs == null){
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡La pqrs no existe!'
            ]);
        }

        return view("admin.pqrs.show", compact("pqrs"));
    }

    /**
     * @abstract Retornar el listado de PQRS respondidas por el usuario autenticado
    */
    public function myResponses()
    {
        // Listar todas las PQRS
        $pqrs_s = Pqrs::where("worker_id", auth()->user()->id)->paginate(15);

        //Encriptar el slug
        foreach ($pqrs_s as $pqrs) {
            $pqrs->slug = SlugManager::encrypt($pqrs->id);
        }

        // Retornar la vista con el listado de PQRS
        return view("admin.pqrs.index", [
            "pqrs_s" => $pqrs_s,
            "title" => "Mis respuestas"
        ]);
    }

    /**
     * @abstract Retornar la vista con la informacion de la PQRS
     */
    public function edit(string $slug)
    {
        // Obtener la PQRS
        $pqrs = ClientsPqrsController::get($slug);

        // Validar si la pqrs existe
        if($pqrs == null){
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡La pqrs no existe!'
            ]);
        }

        // Validar si la PQRS ya fue respondida
        if($pqrs->state->name == "Respondida"){
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡La pqrs ya fue respondida!'
            ]);
        }

        // Encriptar el slug
        $pqrs->slug = SlugManager::encrypt($pqrs->id);

        // Retornar la vista de edicion con la informacion solicitada
        return view("admin.pqrs.edit", compact("pqrs"));
    }

    /**
     * @abstract Responder la PQRS
     */
    public function update(PqrsRequest $request, string $slug)
    {
        try{

            // Ejecutar validaciones personalizadas
            if(!Validator::runInRequest($request,["response"])){
                return redirect()->back()->withInput()->with("message",[
                    'status' => 'danger',
                    'text' => '¡Los datos ingresados no son válidos!'
                ]);
            }

            // Obtener la PQRS
            $pqrs = ClientsPqrsController::get($slug);
            
            // Validar si la pqrs existe
            if($pqrs == null){
                return redirect()->back()->with("message",[
                    'status' => 'danger',
                    'text' => '¡La pqrs no existe!'
                ]);
            }
            // Validar si la PQRS ya fue respondida
            if($pqrs->state->name == "Respondida"){
                return redirect()->back()->with("message",[
                    'status' => 'danger',
                    'text' => '¡La pqrs ya fue respondida!'
                ]);
            }

            DB::transaction(function () use ($request, $pqrs) {

                // Actualizar la PQRS
                $pqrs->response = $request->response;
                $pqrs->worker_id = auth()->user()->id;
                $pqrs->state_id = State::where("name","Respondida")->first()->id;

                // Guardar cambios
                $pqrs->save();

                // Enviar correo de respuesta
                // Mail::to($pqrs->client->email)->send(new ResponsePqrsMail($pqrs));

            });

            // Retornar la vista de edicion con la informacion solicitada
            return redirect()->route("admin.pqrs.index")->with("message",[
                'status' => 'success',
                'text' => '¡La pqrs fue respondida correctamente!'
            ]);

        }catch(Exception){

            // Retornar la vista de edicion con mensaje de error 
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡Ocurrio un error al responder la pqrs!'
            ]);
        }
    }
}
