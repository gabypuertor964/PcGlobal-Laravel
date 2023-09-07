<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    //Relación uno a muchos (inversa)
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'id_categoria');
    }
}
