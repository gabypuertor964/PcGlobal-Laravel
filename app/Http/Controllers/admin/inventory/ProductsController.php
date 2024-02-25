<?php

namespace App\Http\Controllers\admin\inventory;

use App\Helpers\CleanInputs;
use App\Helpers\SlugManager;
use App\Helpers\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\inventory\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Parsedown;

class ProductsController extends Controller
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
            return Product::where('slug', SlugManager::decrypt($slug))->first();
        }catch(Exception){
            return null;
        }
    }

    /**
     * @abstract Almacena una imagen individual del producto
     * 
     * 
    */
    private function saveImage($images,$slug,$replace = False): void
    {

        foreach($images as $key => $image){

            // Instanciamiento imagen
            $photo = Image::make($image);

            //Redimensionar imagen y establecer la resolucion DPI
            $photo->resizeCanvas(1920, 1080);

            //Codificacion de la imagen a png
            $photo->encode('png',100);

            //Generar el nombre del archivo
            $name = ($key+1).'.png';

            //Guardar la imagen
            Storage::put("public/products/$slug/images/$name", $photo->stream());
        }
    }

    /**
     * @abstract Listar los productos registrados
     */
    public function index()
    {
        //Obtener los productos y paginarlos
        $products = Product::paginate(10);

        //Encriptar temporalmente los slugs
        foreach ($products as $product) {
            $product->slug = SlugManager::encrypt($product->slug);
        }

        //Retornar la vista con los productos
        return view('admin.inventory.products.index', compact('products'));
    }

    /**
     * @abstract Retorna la vista para crear un nuevo producto junto con la informacion necesaria
     */
    public function create()
    {
        // Consultar la informacion solicitada
        $categories = Category::all();
        $brands = Brand::all();

        // Retornar la vista con la informacion solicitada
        return view('admin.inventory.products.create', compact('categories', 'brands'));
    }

    /**
     * @abstract Almacena un nuevo producto en la base de datos
     * 
     * @param ProductRequest $request
     * @return void
     */
    public function store(ProductRequest $request)
    {

        return dd($request->all());

        try{
            // Ejecutar las validaciones adicionales
            if(!Validator::runInRequest($request, Product::inputs(), ['slug'])){

                // Retornar a la vista anterior con un mensaje de advertencia
                return redirect()->back()->withInput()->with('message',[
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            DB::transaction(function() use($request){

                // Generar el slug del producto
                $request["slug"] = SlugManager::generateInString($request->name);

                // Crear el producto
                $product = Product::create($request->all());

                /**
                 * Crear el directorio productos (si no existe)
                */
                if(!File::exists(storage_path('app/public/products'))){
                    File::makeDirectory(storage_path('app/public/products'));
                }

                /**
                 * Crear el directorio del producto (si no existen)
                */
                if(!File::exists(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug)))){
                    
                    // Crear el directorio del producto
                    File::makeDirectory(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug)));

                    // Crear el directorio de las imagenes del producto
                    File::makeDirectory(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug).'/images'));
                }

                // Instanciar y limpiar el contenido de la descripcion
                $content = strip_tags((new Parsedown)->text($request->description));

                // Almacenar el contenido en el archivo description.md
                File::put(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug).'/description.md'), $content);

                // Almacenar las imagenes del producto
                $this->saveImage($request->file('images'),CleanInputs::runUpper($product->slug));
            });

            return dd($request->all());
        }catch(Exception){

            //Retornar a la vista anterior con un mensaje de error critico
            return redirect()->back()->withInput()->with('message', [
                'class' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al crear el producto!'
            ]);
        }
        
    }

    /**
     * @abstract Mostrar el producto especificado
     * 
     * @param string $slug Slug del producto
     */
    public function edit(string $slug)
    {
        // Obtener el registro de la categoria
        $product = self::get($slug);

        // Consultar la informacion solicitada
        $categories = Category::all();
        $brands = Brand::all();

        // Verificar si el producto existe
        if($product == null){
            return redirect()->route('inventory.prodcuts.index')->with('message',[
                'status' => 'danger',
                'text' => '¡El producto no existe!'
            ]);
        }

        //Retornar la vista con la informacion solicitada
        return view('admin.inventory.products.edit', compact('product', 'categories', 'brands'));
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
