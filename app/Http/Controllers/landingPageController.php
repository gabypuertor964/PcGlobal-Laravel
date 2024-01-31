<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Parsedown;

class landingPageController extends Controller
{
    /**
     * @abstract Retorna la vista de la página principal
    */
    public function index(){
        return view('landing.index');
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
        $directory = array_diff(
            scandir(storage_path('app/public/products/'. strtoupper($product->slug).'/images')),
            ['..', '.']
        );

        $specs_file = File::get(storage_path('app/public/products/'. strtoupper($product->slug).'/specs.md'));

        $parsedown = new Parsedown();
        $product->specs = $parsedown->text($specs_file);

        /**
         * Consultar y retornar la informacion del producto
        */
        return view('landing.product', compact('product','directory'));
    }
}