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
    public static function getRoles()
    {
            
        //Verificar si el usuario esta autenticado
        if(Auth::check()){

            //Obtener y retornar los roles del usuario            
            return User::find(Auth::user()->id)->getRoleNames();
        }
    
        return null;
    }

    /**
     * @abstract Obtener los permisos de un usuario autenticado
     * @return bool
    */
    public static function verifyPermission(array $permissions): bool
    {
        //Verificar si el usuario esta autenticado
        if(Auth::check()){

            //Obtener y retornar los roles del usuario            
            return User::find(Auth::user()->id)->hasAnyPermission($permissions);
        }
    
        return false;
    }

    /**
     * @abstract Verificar si el usuario tiene un rol especifico
     * @return bool
    */
    public static function hasRole(string $role): bool
    {
        //Verificar si el usuario esta autenticado
        if(Auth::check()){

            //Obtener y retornar los roles del usuario            
            return User::find(Auth::user()->id)->hasRole($role);
        }
    
        return false;
    }
}