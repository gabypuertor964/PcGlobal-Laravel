<?php

namespace App\Http\Controllers\admin\inventory;

use App\Helpers\CleanInputs;
use App\Helpers\SlugManager;
use App\Helpers\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\inventory\CategoriesRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoriesController extends Controller
{
    /**
     * @abstract Consultar y mostrar la lista de categorias
     */
    public function index()
    {
        //Datos a consultar
        $categories = Category::paginate(11);

        //Encriptar los slugs de forma temporal
        foreach($categories as $category){
            $category->slug = SlugManager::encrypt($category->slug);
        }

        //Retornar la vista con la informacion
        return view('admin.inventory.categories.index', compact('categories'));
    }

    /**
     * @abstract Retorna la vista para crear una nueva categoria
     */
    public function create()
    {
        return view('admin.inventory.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        try{

            // Ejecutar las validaciones adicionales
            if(!Validator::runInRequest($request, Category::inputs(), ['photo'])){
                return redirect()->back()->withInput()->with('message',[
                    'class' => 'warning',
                    'message' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            /**
             * Ejecutar la transaccion de la creacion de la categoria
            */
            DB::transaction(function() use($request){

                //Crear la categoria
                $category = Category::create([
                    'name' => $request->name,
                    'slug' => SlugManager::generate(
                        explode(" ",
                            CleanInputs::clean($request->name)
                        )
                    )
                ]);

                /**
                 * Instanciamiento de la imagen de la categoria
                */
                $photo = Image::make($request->file('photo'));

                //Redimensionar imagen y establecer la resolucion DPI
                $photo->resizeCanvas(1280, 720);

                //Codificacion de la imagen a png
                $photo->encode('png',100);

                //Generar el nombre del archivo
                $name = $category->slug.'.png';

                //Guardar la imagen
                Storage::put('public/categories/'.$name, $photo->stream());
            });

            return redirect()->route('inventory.categories.index')->with('message',[
                'class' => 'success',
                'message' => '¡Categoria creada con exito!'
            ]);
            
        }catch(Exception){
            return redirect()->back()->withInput()->with('message',[
               'class' => 'danger',
                'message' => '¡Ha ocurrido un error al intentar crear la categoria!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
