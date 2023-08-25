<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class landingPageController extends Controller
{
    /* 
        Nombre Metodo:

        Objetivo:
    */
    public function index()
    {
        return view('landing_page.home');
    }   

    public function categorias(Categoria $categoria){
        $productos = $categoria->productos()->paginate(9);
        return view('productos.categoria', compact('categoria', 'productos'));
    }
}