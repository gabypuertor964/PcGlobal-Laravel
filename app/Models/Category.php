<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
     * @abstract Declarar la relacion uno a muchos con el modelo Products (Productos) FK: category_id (Default)
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * @abstract Obtener los campos autorizados para ser llenados a través de asignación masiva
     * 
     * @return array
    */
    public static function inputs()
    {
        return (new self())->getFillable();
    }
}
