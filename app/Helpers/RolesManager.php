<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RolesManager{

    /**
     * @abstract Obtener los roles de un usuario autenticado
     * 
     * @return Array
    */
    public static function get()
    {
            
        //Verificar si el usuario esta autenticado
        if(Auth::check()){

            //Obtener y retornar los roles del usuario            
            return User::find(Auth::user()->id)->getRoleNames();
        }
    
        return null;
    }
}