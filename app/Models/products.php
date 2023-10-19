<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    //Definicion campo a consultar en URL Amigables
    public function getRouteKeyName(){
        return 'slug';
    }

    //Relación uno a muchos a categoría (inversa)
    public function category(){
        return $this->belongsTo(categories::class, 'category_id');
    }

    //Relación uno a muchos a marca (inversa)
    public function brand(){
        return $this->belongsTo(brands::class, 'brand_id');
    }
}
