<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\products;
use Illuminate\Support\Facades\File;
use Parsedown;

class landingPageController extends Controller
{
    //Retorno vista principal
    public function index(){
        return view('landing.home');
    }   

    //Consulta y paginado de los productos asociados a la categoria
    public function categoryDetail(categories $category){
        $products = $category->products()->paginate(9);
        
        return view('landing.category', compact('category', 'products'));  
    }

    public function productDetail(products $product){
        

        $category = $product->category;
        $brand = $product->brand;

        if (file_exists(public_path('storage/'. $product->descripcion_1))){
            $contenidoMd = File::get(public_path('storage/'.$product->descripcion_1));
            $parsedown = new Parsedown();
            $descripcion_1 = $parsedown->text($contenidoMd);
        }else{
            $descripcion_1 = $product->descripcion_1;
        }

        // La segunda descripción es opcional, la primera no

        if($product->descripcion_2){
            if(file_exists(public_path('storage/'. $product->descripcion_2))){
                $contenidoMd = File::get(public_path('storage/'.$product->descripcion_2));
                $parsedown = new Parsedown();
                $descripcion_2 = $parsedown->text($contenidoMd);
            }else{
                $descripcion_2 = $product->descripcion_2;
            }
        }else{
            $descripcion_2 = null;
        }

        $descriptions = compact('descripcion_1', 'descripcion_2');

        return view('landing.product', compact('category','brand','product','descriptions'));
    }
}