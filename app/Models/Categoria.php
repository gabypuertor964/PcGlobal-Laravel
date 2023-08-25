<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function productos()
    {
        //Relación uno a muchos
        return $this->hasMany('App\Models\productos', 'id_categoria');
    }
}
