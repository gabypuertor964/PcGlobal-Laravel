<?php

namespace App\Helpers;

use App\Models\Brand;
use App\Models\User;
use Dotenv\Util\Str;

class GetRegister{

    /**
     * @abstract Obtener la información de una marca segun su slug
     * 
     * @param string $slug Slug de la marca
     * 
     * @return \App\Models\Brand
    */
    private static function brand(String $slug)
    {
        return Brand::where('slug', SlugManager::decrypt($slug))->first();
    }

    /**
     * @abstract Obtener la información de un registro segun su tipo y slug
     * 
     * @param string $type Tipo de registro 
     * @param string $slug Slug del registro    
     * 
    */
    public static function Get( String $slug, String $type = "user")
    {
        switch($type)
        {
            case "user":
                return User::where('slug', SlugManager::decrypt($slug))->first();
            break;

            case "brand":
                return self::brand($slug);
            break;
        }
    }

}