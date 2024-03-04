<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    /**
     * @abstract Definir los campos que se pueden llenar de forma masiva
     * 
     * @var array
    */
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'price',
        'stock',
        'slug',
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'brand' => $this->brand->name,
        ];
    }

    /**
     * @abstract Obtener los campos que se pueden llenar de forma masiva
     * 
     * @var array
    */
    public static function inputs()
    {
        return (new self())->getFillable();
    }

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
        return $this->belongsTo(Brand::class);
    }
}