<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @abstract Definir el campo de busqueda por defecto
     * 
     * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @abstract Declara la relacion 1:1 con el modelo Category (Categorias) FK: category_id (Default)
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @abstract Declarar la relacion 1:1 con el modelo Brand (Marcas) FK: brand_id (Default)
    */
    public function brand()
    {
        return $this->belongsTo(Brand::class,"brand_id");
    }

    /**
     * @abstract Obtener el numero unidades registradas
    */
    public function units()
    {
        
    }

    /**
     * @abstract Obtener el numero de unidades disponibles del producto
     * 
     * @return int
    */
    public function unitsAvailable()
    {
        //return $this->hasMany(UnitsAvailable::class);
    }

}