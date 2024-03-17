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
use App\Rules\ValidateMinResolution;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Intervention\Image\Facades\Image;
use Parsedown;

class ProductsController extends Controller
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
        $this->middleware("can:inventory.create")->except(["index"]);
    }

    /**
     * @abstract Obtener el registro segun el slug encriptado
     *
     * @param string $slug
     * @return Product|null
    */
    public static function get(string $slug, bool $is_decrypt = true): mixed
    {
        try{
            if($is_decrypt){
                return Product::where('slug', SlugManager::decrypt($slug))->first();
            }
            return Product::where('slug', $slug)->first();
            
        }catch(Exception){
            return null;
        }
    }

    /**
     * @abstract Obtener los nombres de las imagenes desde su ruta absoluta
     * 
     * @param array $url_images Cadena de ruta de las imagenes
     * @return array
    */
    private static function getNamesToAddress(array $url_images): array
    {
        // Convertir de arreglo a cadena 
        $url_images = $url_images[0];

        # Limpiar la cadena (eliminar los corchetes y comillas dobles)
        $url_images = str_replace(["[", "]", "\""], "", $url_images);

        // Inicializar la lista de nombres
        $names = [];

        // Convertir a una lista
        $url_images = explode(",", $url_images);

        // Recorrer las rutas de las imagenes
        foreach ($url_images as $url) {
            
            // Obtener el nombre del archivo
            $file_name = basename($url);

            // Almacenar el nombre de la imagen
            array_push($names, $file_name);
        }

        // Retornar la lista de nombres
        return $names;
    }

    /**
     * @abstract Obtener el contenido del directorio de las imagenes del producto segun su slug no encriptado
     * 
     * @param string $slug
     * @return array
    */
    public static function getImagesDirectory(string $slug): array
    {
        // Limpiar y convertir a mayusculas el slug
        $slug = CleanInputs::runUpper($slug);

        try{
            // Retornar el contenido del directorio
            return array_diff(
                scandir(storage_path("app/public/products/$slug/images")),
                ['..', '.']
            );
        }catch(Exception){
            return [];
        }
    }

    /** 
     * @abstract Segun el numero de imagenes almacenadas, renomrarlas de forma consecutiva
     * 
     * @param string $slug
     * @return
    */
    private static function renameNewImages(string $slug)
    {
        // Obtener el directorio de las imagenes
        $imagesDirectory = self::getImagesDirectory($slug);

        // Numero de imagenes almacenadas
        $count = count($imagesDirectory);

        foreach ($imagesDirectory as $image) {

            // Generar el nuevo nombre del archivo
            $new_name = ($count).'.png';

            // Renombrar el archivo
            File::move(
                storage_path("app/public/products/$slug/images/$image"),
                storage_path("app/public/products/$slug/images/$new_name")
            );

            // Decrementar el contador
            $count--;
        }
    }

    /**
     * @abstract Almacenar una lista de imagenes en el directorio del producto
     * 
     * @param $images
     * @param string $slug
     * @param bool $replace
     *
     * @return
    */
    private static function saveImage($images, string $slug){
        
        foreach($images as $key => $image){

            // Instanciamiento imagen
            $photo = Image::make($image);

            //Redimensionar imagen y establecer la resolucion DPI
            $photo->resizeCanvas(env("MIN_WIDTH"), env("MIN_HEIGHT"), 'center', false, 'ffffff');

            //Codificacion de la imagen a png
            $photo->encode('png',100);

            //Generar el nombre del archivo
            $name = ($key+1).'.png';

            //Guardar la imagen
            Storage::put("public/products/$slug/images/$name", $photo->stream());
        }

        // Renombrar las imagenes
        #self::renameNewImages($slug);
    }    

    /**
     * @abstract Crear una tabla markdown de las caracteristicas del producto
     * 
     * @param array $specs
     * @param array $values
     * @param string $slug
    */
    private static function createMarkdownSpecs(array $specs, array $values, string $slug)
    {
        // Encabezado de la tabla
        $content = "| Especificacion | Valor | \n";

        // Espacio entre el encabezado y el contenido
        $content .= "| --- | --- | \n";

        // Recorrer las especificaciones y valores
        foreach ($specs as $key => $spec) {
            $content .= "| $spec | $values[$key] | \n";
        }

        // Instanciar y limpiar el contenido de la descripción
        $content = strip_tags($content);

        // Almacenar el contenido en el archivo description.md
        File::put(storage_path("app/public/products/$slug/specs.md"), $content);
    }

    /**
     * @abstract Obtener las listas de las especificaciones del producto segun el archivo markdown
     * @return array
    */
    private static function getListsFromMarkdownSpecs(string $slug): array 
    {
        // Obtener el contenido del archivo
        $content = File::get(storage_path("app/public/products/$slug/specs.md"));

        // Separar el contenido por lineas
        $lines = explode("\n", $content);

        // Eliminar las lineas vacias
        $lines = array_filter($lines);

        // Eliminar las primeras dos lineas (Encabezado y separador)
        array_shift($lines);
        array_shift($lines);

        // Inicializar las listas
        $specs = [];
        $values = [];

        // Recorrer las lineas
        foreach ($lines as $line) {

            // Reemplazar los caracteres los " | " por "|"
            $line = str_replace(" | ", "|", $line);

            // Separar la linea por el caracter |
            $line = explode("|", $line);

            // Eliminar los espacios en blanco
            $line = array_map('trim', $line);

            // Almacenar los valores en las listas
            $specs[] = $line[1];
            $values[] = $line[2];
        }

        // Retornar las listas
        return [
            'specs' => $specs,
            'values' => $values
        ];
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
     */
    public function store(ProductRequest $request)
    {
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

                // Crear el directorio productos (si no existe)
                if(!File::exists(storage_path('app/public/products'))){
                    File::makeDirectory(storage_path('app/public/products'));
                }

                // Crear el directorio del producto (si no existen)
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

                self::createMarkdownSpecs($request->key_specs, $request->value_specs, CleanInputs::runUpper($product->slug));

                // Almacenar las imagenes del producto
                self::saveImage([$request->file('photo')],CleanInputs::runUpper($product->slug));
            });

            //Retornar a la vista anterior con un mensaje de error critico
            return redirect()->route('inventory.products.index')->with('message', [
                'status' => 'success',
                'text' => 'Producto creado exitosamente!'
            ]);

        }catch(Exception){

            //Retornar a la vista anterior con un mensaje de error critico
            return redirect()->back()->withInput()->with('message', [
                'status' => 'danger',
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

        // Verificar si el producto existe
        if($product == null){
            return redirect()->route('inventory.products.index')->with('message',[
                'status' => 'danger',
                'text' => '¡El producto no existe!'
            ]);
        }
 
        // Consultar la informacion solicitada
        $categories = Category::all();
        $brands = Brand::all();

        // Enviar el contenido de los markdowns
        $product->description = File::get(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug).'/description.md'));

        // Enviar el contenido de las especificaciones
        $product->data_specs = self::getListsFromMarkdownSpecs(CleanInputs::runUpper($product->slug));

        // Enviar directorio de imagenes
        #$product->directory_images = self::getImagesDirectory($product->slug);

        $product->image_route = Validator::publicImageExist("storage/products/".CleanInputs::runUpper($product->slug)."/images/1.png");

        //Encriptar el slug
        $product->slug_encrypt = SlugManager::encrypt($product->slug);

        //Retornar la vista con la informacion solicitada
        return view('admin.inventory.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * @abstract Actualizar el producto especificado
     * 
     * @param ProductRequest $request
     * @param string $slug
     */
    public function update(ProductRequest $request, string $slug)
    {
        try{
            
            // Realizar las validaciones adicionales
            if(!Validator::runInRequest($request, Product::inputs(), ['slug'])){

                // Retornar a la vista anterior con un mensaje de advertencia
                return redirect()->back()->withInput()->with('message',[
                    'status' => 'warning',
                    'text' => '¡Verifica los campos y realiza las correcciones necesarias!'
                ]);
            }

            // Obtener el producto
            $product = self::get($slug);

            // Verificar si el producto existe
            if($product == null){
                return redirect()->route('inventory.products.index')->with('message',[
                    'status' => 'danger',
                    'text' => '¡El producto no existe!'
                ]);
            }

            // Validar si se ha subido una nueva imagen
            if ($request->file('photo') != null) {
                
                // Validar la resolucion de la imagen
                $validation =  FacadesValidator::make($request->all(), [
                    'photo' => new ValidateMinResolution(env("MIN_WIDTH"), env("MIN_HEIGHT"))
                ]);

                // Verificar si la validacion falla y retornar un mensaje de error
                if($validation->fails()){
                    return redirect()->back()->withInput()->with('message', [
                        'status' => 'warning',
                        'text' => '¡La imagen debe tener una resolucion minima de '.env("MIN_WIDTH").'x'.env("MIN_HEIGHT").' pixeles!'
                    ]);
                }
            }

            // Ejecutar la transaccion
            DB::transaction(function() use($request, $product){                

                // Generar el slug segun el nombre del producto
                $request["slug"] = SlugManager::generateInString($request->name);

                // Verificar si el slug ha cambiado
                if($product->slug != $request->slug){

                    // Renombrar el directorio del producto
                    File::move(
                        storage_path('app/public/products/'.CleanInputs::runUpper($product->slug)),
                        storage_path('app/public/products/'.CleanInputs::runUpper($request->slug))
                    );
                }

                // Actualizar el producto
                $product->update($request->all());

                // Guardar la informacion
                $product->save();

                // Instanciar y limpiar el contenido de la descripcion
                $content = strip_tags((new Parsedown)->text($request->description));

                // Almacenar el contenido en el archivo description.md
                File::put(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug).'/description.md'), $content);

                // Actualizar la imagen del producto
                if ($request->file('photo') != null) {

                    // Eliminar la imagen anterior
                    File::delete(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug).'/images/1.png'));

                    // Almacenar la nueva imagen del producto
                    self::saveImage([$request->file('photo')], CleanInputs::runUpper($product->slug));
                }

                // Crear y almacenar las especificaciones del producto
                self::createMarkdownSpecs($request->key_specs, $request->value_specs, CleanInputs::runUpper($product->slug));

                /*
                // Listado de imagenes antiguas a conservar
                $old_images = self::getNamesToAddress($request->existing_images);

                // Listado de imagenes almacenadas
                $imagesDirectory = self::getImagesDirectory($product->slug);

                // Eliminar las imagenes que no se encuentran en el listado de imagenes a conservar
                foreach ($imagesDirectory as $image) {

                    if(!in_array($image, $old_images)){
                        File::delete(storage_path("app/public/products/".CleanInputs::runUpper($product->slug)."/images/$image"));
                    }
                }
                
                // Almacenar las nuevas imagenes del producto
                if($request->file('new_images') != null){
                    self::saveImage($request->file('new_images'), CleanInputs::runUpper($product->slug));
                }
                */
                
            });

            //Retornar a la vista anterior con un mensaje de exito
            return redirect()->route('inventory.products.index')->with('message', [
                'status' => 'success',
                'text' => '¡Producto actualizado exitosamente!'
            ]);

        // Retornar a la vista anterior con un mensaje de error critico
        }catch(Exception){
            return redirect()->route("inventory.products.index")->withInput()->with('message', [
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al actualizar el producto!'
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
            // Obtener el registro del producto
            $product = self::get($slug);

            // Verificar si el producto existe
            if($product == null){
                return redirect()->route('inventory.products.index')->with('message',[
                    'status' => 'danger',
                    'text' => '¡El producto no existe!'
                ]);
            }

            // Eliminar el directorio del producto
            File::deleteDirectory(storage_path('app/public/products/'.CleanInputs::runUpper($product->slug)));

            // Eliminar el producto
            $product->delete();

            //Retornar a la vista anterior con un mensaje de exito
            return redirect()->route('inventory.products.index')->with('message', [
                'status' => 'success',
                'text' => '¡Producto eliminado exitosamente!'
            ]);

        }catch(Exception){

            //Retornar a la vista anterior con un mensaje de error critico
            return redirect()->route('inventory.products.index')->with('message', [
                'status' => 'danger',
                'text' => '¡Ha ocurrido un error inesperado al eliminar el producto!'
            ]);
        }
    }
}
