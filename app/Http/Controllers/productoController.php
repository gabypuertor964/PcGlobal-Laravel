<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\productos;
use Illuminate\Support\Facades\File;
use Parsedown;

class ProductoController extends Controller
{
    public function show($categoriaSlug, $productoSlug){
        // Buscar la categoría por su slug
        $categoria = Categoria::where('slug', $categoriaSlug)->firstOrFail();

        // Buscar el producto en la categoría por su slug
        $producto = $categoria->productos()->where('slug', $productoSlug)->firstOrFail();

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


        return view('productos.producto',compact('categoria', 'producto','descripciones'));
    }
}
