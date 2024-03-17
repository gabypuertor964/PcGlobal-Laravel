<?php

namespace App\Http\Controllers\admin\inventory;

use App\Helpers\GetRegister;
use App\Helpers\SlugManager;
use App\Helpers\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\inventory\CategoriesRequest;
use App\Models\Category;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoriesController extends Controller
{
    /**
     * @abstract Metodo constructor de la clase (Middleware)
    */
    public function __construct()
    {
        /**
         * Usuarios autorizados:
         * 
         * index (Listar) -> Almacenista, Gerente
         * show (Ver) -> Gerente
         * create (Crear) -> Almacenista
         * edit (Editar) -> Almacenista
         * update (Actualizar) -> Almacenista
         * destroy (Eliminar) -> Almacenista
        */

        $this->middleware("can:gerency.read")->only(["show"]);
        $this->middleware("can:inventory.create")->except(["index","show"]);
    }

    /**
     * @abstract Obtener el registro segun el slug encriptado
     * 
     * @param string $slug
     * @return Category|null
    */
    public static function get(string $slug): mixed
    {
        try{
            return Category::where('slug', SlugManager::decrypt($slug))->first();
        }catch(Exception){
            return null;
        }
    }

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
     * @abstract Mostrar la categoria especificada
     * 
     * @param string $slug Slug de la categoria
     */
    public function show(string $slug)
    {
        // Obtener el registro de la categoria
        $category = self::get($slug);

        // Verificar si la categoria existe
        if($category == null){
            return redirect()->route('inventory.categories.index')->with('message',[
                'status' => 'danger',
                'text' => '¡La categoria no existe!'
            ]);
        }

        // Verificar si la categoria tiene una imagen asociada
        $category->image = asset("/storage/categories/$category->slug.png");

        //Retornar la vista con la informacion solicitada
        return view('admin.inventory.categories.show', compact('category'));
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
            if(!Validator::runInRequest($request, Category::inputs(), ['photo','slug'])){
                return redirect()->back()->withInput()->with('message',[
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            /**
             * Ejecutar la transaccion de la creacion de la categoria
            */
            DB::transaction(function() use($request){

                //Crear la categoria
                $category = Category::create([
                    'name' => $request->name,
                    'slug' => SlugManager::generateInString($request->name),
                ]);

                /**
                 * Instanciamiento de la imagen de la categoria
                */
                $photo = Image::make($request->file('photo'));

                //Redimensionar imagen y establecer la resolucion DPI
                $photo->resizeCanvas(1920, 1080);

                //Codificacion de la imagen a png
                $photo->encode('png',100);

                //Generar el nombre del archivo
                $name = $category->slug.'.png';

                //Guardar la imagen
                Storage::put('public/categories/'.$name, $photo->stream());
            });

            return redirect()->route('inventory.categories.index')->with('message',[
                'status' => 'success',
                'text' => '¡Categoria creada con exito!'
            ]);
            
        }catch(Exception){
            return redirect()->back()->withInput()->with('message',[
                'status' => 'danger',
                'text' => "¡Ha ocurrido un error inesperado al crear la categoria!"
            ]);
        }
    }

    /**
     * @abstract Mostrar la categoria especificada
     * 
     * @param string $slug Slug de la categoria
     */
    public function edit(string $slug)
    {
        // Obtener el registro de la categoria
        $category = self::get($slug);

        // Verificar si la categoria existe
        if($category == null){
            return redirect()->route('inventory.categories.index')->with('message',[
                'status' => 'danger',
                'text' => '¡La categoria no existe!'
            ]);
        }

        // Verificar si la categoria tiene una imagen asociada
        $category->image = asset("/storage/categories/$category->slug.png");

        //Añadir registro de slug encriptado
        $category->slug = SlugManager::encrypt($category->slug);

        //Retornar la vista con la informacion solicitada
        return view('admin.inventory.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriesRequest $request, string $slug)
    {
        try{

            // Ejecutar las validaciones adicionales
            if(!Validator::runInRequest($request, Category::inputs(), ['slug'])){
                return redirect()->back()->withInput()->with('message',[
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            /**
             * Ejecutar la transaccion de la actualizacion de la categoria
            */
            DB::transaction(function() use($request, $slug){
                # Obtener el registro de la categoria
                $category = GetRegister::Get($slug, 'category');

                /**
                 * Verificar si se ha enviado una nueva imagen y realizar el proceso de actualizacion
                */
                if(!is_null($request->photo)){
                    /**
                     * Instanciamiento de la imagen de la categoria
                    */
                    $photo = Image::make($request->file('photo'));

                    //Redimensionar imagen y establecer la resolucion DPI
                    $photo->resizeCanvas(1920, 1080);

                    //Codificacion de la imagen a png
                    $photo->encode('png',100);

                    //Generar el nombre del archivo
                    $name = $category->slug.'.png';

                    //Guardar la imagen
                    Storage::put('public/categories/'.$name, $photo->stream());
                }

                /**
                 * Renombrar la imagen de la categoria en caso de que el nombre haya cambiado
                */
                if($category->name != $request->name){
                    (new Filesystem)->move(
                        public_path('storage/categories/'.$category->slug.'.png'),
                        public_path('storage/categories/'.SlugManager::generateInString($request->name).'.png')
                    );
                }

                # Actualizar la categoria
                $category->update([
                    'name' => $request->name,
                    'slug' => SlugManager::generateInString($request->name),
                ]);
                $category->save();
            });

            return redirect()->route('inventory.categories.index')->with('message',[
                'status' => 'success',
                'text' => '¡Categoria actualizada con exito!'
            ]);
        
        }catch(Exception){

            //Retornar la vista con el mensaje de error
            return redirect()->back()->withInput()->with('message',[
                'status' => 'danger',
                'text' => "¡Ha ocurrido un error inesperado al actualizar la categoria!"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try{
            # Obtener el registro de la categoria
            $category = GetRegister::Get($slug, 'category');

            //Validar si la categoria existe
            if($category == null){
                return redirect()->back()->with('message',[
                    'status' => 'warning',
                    'text' => '¡La categoria que intentas eliminar no existe!'
                ]);
            }

            // Ejecutar la transaccion de eliminacion de la categoria
            DB::transaction(function() use($category){

                //Eliminar la imagen de la categoria
                Storage::delete('public/categories/'.$category->slug.'.png');

                //Eliminar la categoria
                $category->delete();
            });

            return redirect()->route('inventory.categories.index')->with('message',[
                'status' => 'success',
                'text' => '¡Categoria eliminada exitosamente!'
            ]);


        }catch(Exception){

            //Mensaje de error critico
            return redirect()->back()->with('message',[
                'status' => 'danger',
                'text' => "¡Ha ocurrido un error inesperado al eliminar la categoria!"
            ]);
        }
    }
}
