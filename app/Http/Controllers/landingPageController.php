<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class landingPageController extends Controller
{
    //Retorno vista principal
    public function index()
    {
        return view('landing_page.home');
    }   

    //Consulta y paginado de los productos asociados a la categoria
    public function categoryDetail(Categoria $categoria){
        $productos = $categoria->productos()->paginate(9);
        
        return view('productos.categoria', compact('categoria', 'productos'));
    }
}