<?php

namespace App\Http\Controllers\admin;

use App\Helpers\SlugManager;
use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class WorkersController extends Controller
{
    /**
     * @abstract Obtener el registro segun el slug encriptado
     *
     * @param string $slug
     * @return Product|null
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

        // Obtener solo los usuariosempleados
        $workers = User::whereDoesntHave('roles', function ($query) {
            $query->where('id', 1);
        })->paginate(10);

        //Encriptar temporalmente los slugs
        foreach ($workers as $worker) {
            $worker->names = ucfirst(strtolower($worker->names));
            $worker->surnames = ucfirst(strtolower($worker->surnames));
            $worker->slug = SlugManager::encrypt($worker->id);
            $rolName = $worker->roles->first()->name;
            $worker->role = ucfirst(str_replace('_', ' ', $rolName));
        }
        return view("admin.workers.index", compact("workers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Consultar la informacion solicitada
        $genders = Gender::all();
        $document_types = DocumentType::all();
        $roles = Role::all();

        //Retornar la vista con la informacion solicitada
        return view('admin.workers.create', compact('genders', 'document_types', 'roles'));
    }

    /**
     * @abstract Almacena un nuevo empleado en la base de datos
     * 
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
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
        
        $worker->names = ucfirst(strtolower($worker->names));
        $worker->surnames = ucfirst(strtolower($worker->surnames));
    
        if($worker == null){
            return redirect()->route('admin.workers.index')->with('message',[
                'status' => 'danger',
                'text' => '¡El empleado no existe!'
            ]);
        }
    
        // Consultar la informacion solicitada
        $genders = Gender::all();
        $document_types = DocumentType::all();
        $roles = Role::all();
    
        //Encriptar el slug
        $worker->slug_encrypt = SlugManager::encrypt($worker->id);
    
        //Retornar la vista con la informacion solicitada
        return view('admin.workers.edit', compact('worker', 'genders', 'document_types', 'roles'));
    }

    /**
     * @abstract Actualizar el empleado especificado
     * 
     * @param Request $request
     * @param string $slug
     */
    public function update(Request $request, string $slug)
    {
        //
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

            // Verificar si el producto existe
            if($worker == null){
                return redirect()->route('admin.workers.index')->with('message',[
                    'status' => 'danger',
                    'text' => '¡El producto no existe!'
                ]);
            }

            // Eliminar el empleado
            $worker->delete();

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
