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
}
