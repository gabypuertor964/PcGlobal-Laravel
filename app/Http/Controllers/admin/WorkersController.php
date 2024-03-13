<?php

namespace App\Http\Controllers\admin;

use App\Helpers\SlugManager;
use App\Helpers\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\WorkersRequest;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class WorkersController extends Controller
{
    /**
     * @abstract Obtener el registro segun el slug encriptado
     *
     * @param string $slug
     * @return User|null
    */
    public static function get(string $slug): mixed
    {
        try{
            return User::where('id', SlugManager::decrypt($slug))->first();
        }catch(Exception){
            return null;
        }
    }

    /**
     * @abstract Listar los empleados registrados
     */
    public function index()
    {

        /**
         * Exclusiones: Usuarios con el rol de cliente y gerente
        */
        $workers = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'cliente');
        })->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'gerente');
        })->paginate(10);

        // Limpiar y organizar la informacion
        foreach ($workers as $worker) {

            $worker->slug = SlugManager::encrypt($worker->id);
            $rolName = $worker->roles->first()->name;
            $worker->role = ucfirst(str_replace('_', ' ', $rolName));

        }

        # Retornar la vista con la informacion solicitada
        return view("admin.workers.index", compact("workers"));
    }

    /**
     * @abstract Mostrar el formulario para crear un nuevo empleado
     */
    public function create()
    {
        // Consultar la informacion solicitada
        $genders = Gender::all();
        $document_types = DocumentType::all();
        $roles = Role::all()->where('name',"!=", "cliente")->where('name',"!=", "gerente");

        //Retornar la vista con la informacion solicitada
        return view('admin.workers.create', compact('genders', 'document_types', 'roles'));
    }

    /**
     * @abstract Almacena un nuevo empleado en la base de datos
     * 
     * @param Request $request
     */
    public function store(WorkersRequest $request)
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
                    'names'=>$request->names,
                    'surnames'=>$request->surnames,
                    'gender_id'=>$request->gender_id,
                    'document_type_id'=>$request->document_type_id,
                    'document_number'=>$request->document_number,
                    'phone_number'=>$request->phone_number,
                    'date_birth'=>$request->date_birth,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password)
                ])->assignRole(Role::findById($request->role_id));
            });

            //Redireccion al login con mensaje de exito
            return redirect()->route("admin.workers.index")->with('message',[
                'status'=>'success',
                'text'=>'¡Empleado registrado exitosamente!'
            ]);


        }catch(Exception){
            return redirect()->back()->withInput()->with('message',[
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al registrar el empleado!'
            ]);
        }
    }

    /**
     * @abstract Mostrar el empleado especificado
     *
     * @param string $slug Slug del empleado
     */
    public function edit(string $slug)
    {
        // Obtener el registro de la categoria
        $worker = self::get($slug);
        
        if($worker == null){
            return redirect()->route('admin.workers.index')->with('message',[
                'status' => 'danger',
                'text' => '¡El empleado no existe!'
            ]);
        }
    
        // Consultar la informacion solicitada
        $genders = Gender::all();
        $document_types = DocumentType::all();
        $roles = Role::all()->where('name',"!=", "cliente")->where('name',"!=", "gerente");
    
        //Encriptar el slug
        $worker->slug = SlugManager::encrypt($worker->id);
    
        //Retornar la vista con la informacion solicitada
        return view('admin.workers.edit', compact('worker', 'genders', 'document_types', 'roles'));
    }

    /**
     * @abstract Actualizar el empleado especificado
     * 
     * @param Request $request
     * @param string $slug
     */
    public function update(WorkersRequest $request, string $slug)
    {
        try{

            /**
             * Ejecutar las validaciones adicionales
            */
            if(!Validator::runInRequest($request,User::inputs(),["password"])){

                // Redireccion a la vista de registro con mensaje de advertencia
                return redirect()->back()->withInput()->with('message',[
                    'status'=>'warning',
                    'text'=>'¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            // Obtener el registro del empleado
            $worker = self::get($slug);

            // Verificar si el empleado existe
            if($worker == null){
                return redirect()->route('admin.workers.index')->with('message',[
                    'status' => 'danger',
                    'text' => '¡El empleado no existe!'
                ]);
            }

            # Transaccion para la actualizacion del empleado
            DB::transaction(function() use($request, $worker){

                # Actualizar la informacion del empleado
                $worker->update([
                    'names'=>$request->names,
                    'surnames'=>$request->surnames,
                    'gender_id'=>$request->gender_id,
                    'document_type_id'=>$request->document_type_id,
                    'document_number'=>$request->document_number,
                    'phone_number'=>$request->phone_number,
                    'date_birth'=>$request->date_birth,
                    'email'=>$request->email
                ]);

                # Actualizar la contraseña si se ha especificado
                if($request->password != null){
                    $worker->update([
                        'password'=>Hash::make($request->password)
                    ]);
                }

                # Actualizar el rol del empleado
                $worker->syncRoles(Role::findById($request->role_id));
            });

            //Retornar a la vista anterior con un mensaje de exito
            return redirect()->route('admin.workers.index')->with('message', [
                'status' => 'success',
                'text' => '¡Empleado actualizado exitosamente!'
            ]);

        }catch(Exception){
            return redirect()->back()->withInput()->with('message',[
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al actualizar el empleado!'
            ]);
        }
    }

    /**
     * @abstract Eliminar el producto especificado
     * @param string $slug
     */
    public function destroy(string $slug)
    {
        try{
            // Obtener el registro del empleado
            $worker = self::get($slug);

            // Verificar si el empleado existe
            if($worker == null){
                return redirect()->route('admin.workers.index')->with('message',[
                    'status' => 'danger',
                    'text' => '¡El empleado no existe!'
                ]);
            }

            # Transaccion para la eliminacion del empleado
            DB::transaction(function() use($worker){
                $worker->delete();
            });

            //Retornar a la vista anterior con un mensaje de exito
            return redirect()->route('admin.workers.index')->with('message', [
                'status' => 'success',
                'text' => '¡Empleado eliminado exitosamente!'
            ]);

        }catch(Exception){

            //Retornar a la vista anterior con un mensaje de error critico
            return redirect()->route('admin.workers.index')->with('message', [
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al eliminar el producto!'
            ]);
        }
    }
}
