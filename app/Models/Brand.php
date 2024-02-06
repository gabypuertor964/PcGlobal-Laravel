<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * @abstract Relación uno a muchos con el modelo Product (productos) FK: brand_id (Default)
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
