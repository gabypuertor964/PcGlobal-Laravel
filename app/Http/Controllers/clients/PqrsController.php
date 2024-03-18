<?php

namespace App\Http\Controllers\clients;

use App\Helpers\SlugManager;
use App\Helpers\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\client\PqrsRequest;
use App\Mail\facturation\CreateFacturationMail;
use App\Mail\pqrs\CreatePqrsMail;
use App\Mail\pqrs\DeletePqrsEmail;
use App\Mail\pqrs\ResponsePqrsMail;
use App\Models\Pqrs;
use App\Models\PqrsType;
use App\Models\SaleInvoice;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PqrsController extends Controller
{
    /**
     * @abstract Obtener la informacion de la PQRS segun su slug
     * 
     * @param string $slug
     * @return Pqrs|null
     */
    public static function get(string $slug): ?Pqrs
    {
        try{
            return Pqrs::where("id", SlugManager::decrypt($slug))->first();
        }catch(Exception){
            return null;
        }
    }

    /**
     * @abstract Listar las PQRS del cliente
     */
    public function index()
    {
        // Obtener la informacion del usuario autenticado
        $user = User::find(Auth::user()->id);

        // Validar el rol del usuario autenticado
        if(!$user->hasRole("cliente")){
            abort(403);
        }

        // Obtener las PQRS del usuario autenticado
        $pqrs_s = Pqrs::where("client_id", "=", Auth::user()->id)->paginate(10);

        // Encriptar el id de los registros
        foreach ($pqrs_s as $pqrs) {
            $pqrs->slug = SlugManager::encrypt($pqrs->id);

            // Separar los campos fecha y hora
            $pqrs->datetime = FacturationController::getDateTimeInArray($pqrs->created_at);
        }

        // Retornar la vista con las PQRS
        return view("clients.pqrs.index", compact("pqrs_s"));
    }

    /**
     * @abstract Crear una nueva PQRS
     */
    public function create()
    {
        // Consultar los tipos de PQRS
        $pqrs_types = PqrsType::all();

        // Retornar la vista con los tipos de PQRS
        return view("clients.pqrs.create", compact("pqrs_types"));
    }

    /**
     * @abstract Almacenar la nueva PQRS
     */
    public function store(PqrsRequest $request)
    {
        try{

            // Listado de campos a excluir de la validacion
            $except = [
                "client_id",
                "date_ocurrence",
                "worker_id",
                "response",
                "state_id"
            ];

            // Ejecutar las validaciones personalizadas
            if(!Validator::runInRequest($request, Pqrs::inputs(), $except)){
                return redirect()->back()->with("message",[
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            //Obtener la informacion del usuario autenticado
            $user = User::find(Auth::user()->id);

            // Incluir el id del cliente en la peticion
            $request->merge(["client_id" => $user->id]);

            // Consultar el estado "En espera" de las PQRS
            $request->merge(["state_id" => DB::table("states")->where("name","=","En espera")->first()->id]);

            DB::transaction(function() use($request, $user){
                // Crear la PQRS
                $pqrs = Pqrs::create($request->all());

                // Envio de Correo electronico
                Mail::to($user->email)->send(new CreatePqrsMail($pqrs));
            });

            return redirect()->back()->with("message",[
                'status' => 'success',
                'text' => '¡PQRS registrada correctamente!'
            ]);

        }catch(Exception){
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al registrar la PQRS'
            ]);
        }
    }

    /**
     * Ver la informacion de la PQRS
     */
    public function edit(string $slug)
    {
        // Obtener la informacion de la PQRS
        $pqrs = self::get($slug);

        // Verificar si la PQRS no existe
        if($pqrs == null){
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡La PQRS seleccionada no existe!'
            ]);
        }

        // Verificar si el cliente no tiene asociada esta PQRS
        if($pqrs->client_id != Auth::user()->id){
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡Usted no tiene asociada esta PQRS!'
            ]);
        }

        // Retornar la vista con la informacion de la PQRS
        return view("clients.pqrs.edit", compact("pqrs"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PqrsRequest $request, string $slug)
    {
        try{

            // Listado de campos a excluir de la validacion
            $except = [
                "client_id",
                "date_ocurrence",
                "worker_id",
                "response",
                "state_id"
            ];

            // Ejecutar las validaciones personalizadas
            if(!Validator::runInRequest($request, Pqrs::inputs(), $except)){
                return redirect()->back()->with("message",[
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            // Obtener la informacion de la PQRS
            $pqrs = self::get($slug);

            // Verificar si la PQRS no existe
            if($pqrs == null){
                return redirect()->back()->with("message",[
                    'status' => 'danger',
                    'text' => '¡La PQRS seleccionada no existe!'
                ]);
            }

            // Verificar si el cliente no tiene asociada esta PQRS
            if($pqrs->client_id != Auth::user()->id){
                return redirect()->back()->with("message",[
                    'status' => 'danger',
                    'text' => '¡Usted no tiene asociada esta PQRS!'
                ]);
            }

            // Actualizar la PQRS
            DB::transaction(function() use($request, $pqrs){
                $pqrs->update($request->all());
                $pqrs->save();

                // Envio de Correo electronico
                Mail::to($pqrs->client->email)->send(new ResponsePqrsMail($pqrs));
            });

            // Retornar el mensaje de exito
            return redirect()->back()->with("message",[
                'status' => 'success',
                'text' => '¡PQRS actualizada correctamente!'
            ]);

        }catch(Exception){
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al actualizar la PQRS'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try{
            // Obtener la informacion de la PQRS
            $pqrs = self::get($slug);

            // Verificar si la PQRS no existe
            if($pqrs == null){
                return redirect()->back()->with("message",[
                    'status' => 'danger',
                    'text' => '¡La PQRS seleccionada no existe!'
                ]);
            }

            // Verificar si el cliente no tiene asociada esta PQRS
            if($pqrs->client_id != Auth::user()->id){
                return redirect()->back()->with("message",[
                    'status' => 'danger',
                    'text' => '¡Usted no tiene asociada esta PQRS!'
                ]);
            }

            // Eliminar la PQRS
            DB::transaction(function() use($pqrs){
                $pqrs->delete();
            });

            // Envio de correo electronico
            Mail::to($pqrs->client->email)->send(new DeletePqrsEmail($pqrs));

            // Retornar el mensaje de exito
            return redirect()->back()->with("message",[
                'status' => 'success',
                'text' => '¡PQRS eliminada correctamente!'
            ]);

        }catch(Exception){

            // Retornar el mensaje de error
            return redirect()->back()->with("message",[
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al eliminar la PQRS'
            ]);
        }
    }
}
