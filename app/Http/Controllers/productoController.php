<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use Illuminate\Support\Facades\File;
use Parsedown;

class productoController extends Controller
{
    public function show(productos $producto){

        $categoria = $producto->categoria;
        $marca = $producto->marca;

        if (file_exists(public_path('storage/'. $producto->descripcion_1))){
            $contenidoMd = File::get(public_path('storage/'.$producto->descripcion_1));
            $parsedown = new Parsedown();
            $descripcion_1 = $parsedown->text($contenidoMd);
        }else{
            $descripcion_1 = $producto->descripcion_1;
        }

        // La segunda descripción es opcional, la primera no

        if($producto->descripcion_2){
            if(file_exists(public_path('storage/'. $producto->descripcion_2))){
                $contenidoMd = File::get(public_path('storage/'.$producto->descripcion_2));
                $parsedown = new Parsedown();
                $descripcion_2 = $parsedown->text($contenidoMd);
            }else{
                $descripcion_2 = $producto->descripcion_2;
            }
        }else{
            $descripcion_2 = null;
        }

        $descripciones = compact('descripcion_1', 'descripcion_2');


        return view('productos.producto',compact('categoria','marca','producto','descripciones'));
    }
}
