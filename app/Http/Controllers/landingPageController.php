<?php

namespace App\Http\Controllers;

use App\Helpers\Validator;
use App\Http\Controllers\admin\inventory\ProductsController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Parsedown;

class landingPageController extends Controller
{
    /**
     * @abstract Retorna la vista de la página principal
    */
    public function index(){

        // Obtener el listado de categorias
        $categories = Category::all();

        // Verificar si la categoria tiene una imagen asociada
        foreach($categories as $category){
            $category->image = Validator::publicImageExist("/storage/categories/$category->slug.png");
        }

        return view('landing.index',compact('categories'));
    }   

    /**
     * @abstract Consultar y retornar los productos asociados a una categoria
    */
    public function categoryDetail(Category $category){

        //Consultar y paginar los productos asociados
        $products = $category->products()->paginate(12);
        
        //Retornar la vista con los datos consultados
        return view('landing.category', compact('category', 'products'));
    }

    /**
     * @abstract Consultar y retornar la informacion detallada del producto
    */
    public function productDetail(Product $product){
        
        //Contar el numero de imagenes asociadas al producto
        $directory = ProductsController::getImagesDirectory($product->slug);
        
        // Descripcion del producto
        $description_file = File::get(storage_path('app/public/products/'. strtoupper($product->slug).'/description.md'));
        
        // Especificaciones del producto
        $specs_file = File::get(storage_path('app/public/products/'. strtoupper($product->slug).'/specs.md'));
        
        //Convertir el archivo de texto a HTML
        $product->description = (new Parsedown)->text($description_file);
        $product->specs = (new Parsedown)->text($specs_file);
        
        // Retornar la vista con la informacion solicitada
        return view('landing.product', compact('product','directory'));
    }
    
    /**
     * @abstract Consultar productos buscados en el cuadro de búsqueda
     * FIXME: Aún no está acabado
    */

    public function searchProduct(Request $request) {
    
        $query = $request->name;
    
        $products = Product::search($query)->get()->first();

        if ($products) return redirect()->route("product.show", $products->slug);

        return "No hay resultados";
        
    }

}