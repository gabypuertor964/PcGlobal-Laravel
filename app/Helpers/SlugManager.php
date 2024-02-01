<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

/**
 * @abstract Administrador y manejador de slugs
*/
class SlugManager{

    /**
     * @abstract Generar un slug basado en una lista de palabras
     * 
     * @param Array $data
     * @return String
    */
    public static function generate(Array $data): String
    {
        $slug = "";

        /* Acceso al listado */
        foreach($data as $register){
            if(Validator::run($register)){

                //Concatenacion del registro al slug actual
                $slug .= CleanInputs::runLower($register);

                //Adicion del guion separador en caso de no se el ultimo registro
                if(end($data) != $register){
                    $slug .= "-";
                }
            }
        }

        return $slug;
    }

    /**
     * @abstract Encriptar un slug ya construido
     * 
     * @param string $slug
     * @return String
    */
    public static function encrypt(String $slug)
    {
        return urlencode(Crypt::encrypt($slug));
    }

    /**
     * @abstract Generar y encriptar un slug basado en una lista de palabras
     * 
     * @param Array $data
     * @return String
     */
    public static function encryptFromData(array $data)
    {
        return urlencode(self::encrypt(self::generate($data)));
    }

    /**
     * @abstract Desencriptar un slug
     * 
     * @param string $encrypted_slug
     * @return array
     * 
     */
    public static function decrypt(string $encrypted_slug)
    {
        /**
         * Exception: DecryptException
         * 
         * @abstract Excepcion que se genera cuando el slug no se puede desencriptar o no es valido
        */
        try{
            return Crypt::decrypt(urldecode($encrypted_slug));
        }catch(DecryptException){
            abort(404);
        }
    }
}