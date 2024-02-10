<?php

namespace App\Helpers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

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
     * @abstract Obtener la información de un usuario segun su slug
     * 
     * @param string $slug Slug del usuario
     * @return \App\Models\User
    */
    private static function user(String $slug)
    {
        return User::where('slug', SlugManager::decrypt($slug))->first();
    }

    /**
     * @abstract Obtener la información de una categoria segun su tipo y slug
     * 
     * @param string $slug Slug de la categoria
     * @return \App\Models\Category
    */
    private static function category(String $slug)
    {
        return Category::where('slug', SlugManager::decrypt($slug))->first();
    }

    /**
     * @abstract Obtener la informacion de un producto segun su slug
     * 
     * @param string $slug Slug del producto
     * @return \App\Models\Product
    */
    private static function product(String $slug)
    {
        return Product::where('slug', SlugManager::decrypt($slug))->first();
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
                return self::user($slug);
            break;

            case "brand":
                return self::brand($slug);
            break;

            case "category":
                return self::category($slug);
            break;

            case "product":
                return self::product($slug);
            break;
        }
    }

}