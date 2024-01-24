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
}
