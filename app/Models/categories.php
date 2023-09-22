<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    //Definicion campo a consultar en URL Amigables
    public function getRouteKeyName(){
        return 'slug';
    }

    //Relacion uno a muchos
    public function products(){

        /*
            Sintaxis:
                $this->hasMany(
                    Modelo a relacionar [tabla emisora], 
                    campo de la tabla actual [campo receptor]
                )
        */
        return $this->hasMany(products::class,'category_id');
    }
}
