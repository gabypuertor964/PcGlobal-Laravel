<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\products;
use Illuminate\Support\Facades\DB;

class landingPageController extends Controller
{
    //Retorno vista principal
    public function index(){
        return view('landing_page.home');
    }   

    //Consulta y paginado de los productos asociados a la categoria
    public function categoryDetail(categories $category){
        return $category;

        /*$products = $category->products()->paginate(9);
        
        return view('productos.categoria', compact('category', 'products'));*/  
    }

    public function productDetail(products $product){
        return $product;

        //return view('productos.producto', compact('product'));
    }
}