<?php

namespace App\Helpers;

use App\Models\User;

class GetRegister{


    /**
     * @abstract Obtener la información de un usuario segun su slug
     * 
     * @param string $type Tipo de usuario
     * @param string $slug Slug del usuario
     * 
     * @return \App\Models\User
    */
    public static function Get(String $slug)
    {
        return User::where('slug', SlugManager::decrypt($slug))->first();
    }

}