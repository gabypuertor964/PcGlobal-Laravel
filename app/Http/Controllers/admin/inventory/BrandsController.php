<?php

namespace App\Http\Controllers\admin\inventory;

use App\Helpers\CleanInputs;
use App\Helpers\GetRegister;
use App\Helpers\SlugManager;
use App\Helpers\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\inventory\BrandRequest;
use App\Models\Brand;
use Exception;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    /**
     * @abstract Metodo constructor y declaracion de middlewares
    */
    public function __construct()
    {
        //Middleware de permisos especificos
        $this->middleware('can:inventory.create')->only('create','store');
        $this->middleware('can:inventory.delete')->only('delete');
        $this->middleware('can:inventory.update')->only('edit','update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Consultar la informacion solicitada
        $brands = Brand::paginate(10);

        //Encriptar los slugs de forma temporal
        foreach($brands as $brand){
            $brand->slug = SlugManager::encrypt($brand->slug);
        }

        //Retornar la vista con la informacion
        return view('admin.inventory.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inventory.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try{

            // Ejecutar las validaciones adicionales
            if(!Validator::runInRequest($request,Brand::inputs(),['slug'])){

                //Redireccion con mensaje de error de advertencia
                return redirect()->back()->withInput()->with('message', [
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            /**
             * Transaccion para la creacion de una marca
            */
            DB::transaction(function() use($request){
                Brand::create([
                    'name' => CleanInputs::runUpper($request->name),
                    'slug' => SlugManager::generate(explode(" ",CleanInputs::runLower($request->name)))
                ]);
            });

            //Redireccion con mensaje de exito
            return redirect()->route('inventory.brands.index')->with('message', [
                'status' => 'success',
                'text' => '¡Marca registrada correctamente!'
            ]);

        }catch(Exception){

            //Redireccion con mensaje de error critico
            return redirect()->back()->withInput()->with('message', [
                'status' => 'danger',
                'text' => 'Ha ocurrido un error al intentar registrar la marca.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        try{
            //Desencriptar el slug
            $slug = SlugManager::decrypt($slug);

            //Consultar la informacion solicitada
            $brand = Brand::where('slug',$slug)->first();

            //Validar si la marca existe
            if($brand == null){

                //Redireccion con mensaje de error
                return redirect()->route('inventory.brands.index')->with('message', [
                    'status' => 'danger',
                    'text' => '¡La marca no existe!'
                ]);
            }

            //Encriptar el slug de forma temporal
            $brand->slug = SlugManager::encrypt($brand->slug);

            //Retornar la vista con la informacion
            return view('admin.inventory.brands.edit', compact('brand'));

        }catch(Exception){

            //Redireccion con mensaje de error critico
            return redirect()->route('inventory.brands.index')->with('message', [
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error al intentar editar la marca!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $slug)
    {
        try{

            // Ejecutar las validaciones adicionales
            if(!Validator::runInRequest($request,Brand::inputs(),['slug'])){

                //Redireccion con mensaje de error de advertencia
                return redirect()->back()->withInput()->with('message', [
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            /**
             * Transaccion para la actualizacion de una marca
            */
            DB::transaction(function() use($request,$slug){

                $brand = GetRegister::Get($slug, 'brand');

                //Actualizar la informacion
                $brand->name = CleanInputs::runUpper($request->name);
                $brand->slug = SlugManager::generate(explode(" ",CleanInputs::runLower($request->name)));
                $brand->save();
            });

            //Redireccion con mensaje de exito
            return redirect()->route('inventory.brands.index')->with('message', [
                'status' => 'success',
                'text' => '¡Marca actualizada correctamente!'
            ]);

        }catch(Exception){

            //Redireccion con mensaje de error critico
            return redirect()->route('inventory.brands.index')->with('message', [
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error al intentar editar la marca!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try{

            DB::transaction(function() use($slug){

                $brand = GetRegister::Get($slug, 'brand');

                //Validar si la marca existe
                if($brand == null){

                    //Redireccion con mensaje de error
                    return redirect()->route('inventory.brands.index')->with('message', [
                        'status' => 'danger',
                        'text' => '¡La marca no existe!'
                    ]);
                }

                //Eliminar la marca
                $brand->delete();
            });

            //Redireccion con mensaje de exito
            return redirect()->route('inventory.brands.index')->with('message', [
                'status' => 'success',
                'text' => '¡Marca eliminada correctamente!'
            ]);

        }catch(Exception){

            //Redireccion con mensaje de error critico
            return redirect()->route('inventory.brands.index')->with('message', [
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error al intentar editar la marca!'
            ]);
        }
    }
}
