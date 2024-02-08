<?php

namespace App\Helpers;

use App\Helpers\Validator;
use App\Models\User;

/**
 * @abstract Aseador de entradas de texto
*/
class CleanInputs{
 
    /**
     * @abstract Ejecutar las operaciones de limpieza y conversion a mayusculas
     * 
     * @param ?String $text
     * @return String
    */
    public static function runUpper(?String $text): String
    {
        /**
         * Ejecutar las validaciones de seguridad
        */
        if(Validator::run($text)){

            //Retornar la cadena limpiada
            return self::upper(self::clean($text));

        }else{
            return "";
        }
    }

    /**
     * @abstract Ejecutar las operaciones de limpieza y conversion a minusculas
     * 
     * @param ?string $text
     * @return string
    */
    public static function runLower(?String $text): String
    {
        //Verificar si el texto es nulo
        if(Validator::run($text)){

            //Retornar la cadena limpiada
            return self::lower(self::clean($text));

        }else{
            return "";
        }
    }

    /**
     * @abstract Ejecutar las operaciones de limpieza y conversion a minusculas en una lista de palabras
     * 
     * @param array $data
     * @return string
    */
    public static function runLowerInList(Array $data): array
    {
        //Inicializacion del listado
        $array = [];

        //Acceso al listado
        foreach($data as $register){
            if(Validator::run($register)){

                // Reemplazo del registro por la cadena limpiada
                $register = self::lower(self::clean($register));

                // Adicionar del registro al listado
                if($register != "" || $register != null)
                {
                    array_push($array, $register);
                }
            }
        }

        return $array;
    }

    /**
     * @abstract Eliminar los espacios en blanco innecesarios de una cadena
     * 
     * @param String $text
     * @return String
    */
    public static function clean(String $text): String
    {
        return trim(preg_replace('/\s+/', ' ', $text));       
    }
    
    /**
     * @abstract Convertir la cadena a mayusculas
     * 
     * @param String $text
     * @return String
    */
    public static function upper(String $text): String
    {
        return strtoupper($text);
    }

    /**
     * @abstract Convertir la cadena a minusculas
     * 
     * @param String $text
     * @return String
    */
    public static function lower(String $text): String
    {
        return strtolower($text);
    }

    /**
     * @abstract Convertir la primera letra de la cadena a mayuscula
     * 
     * @param string $text
     * @return string
    */
    public static function capitalize(String $text): String
    {
        return ucwords(strtolower(self::clean($text)));
    }

    /**
     * @abstract Convertir una lista de palabras en una cadena con la primera letra de cada palabra en mayuscula
     * 
     * @abstract Convertir los nombres y apellidos de un modelo en una cadena con la primera letra de cada palabra en mayuscula
     * 
     * @param mixed $data
     * @return string
    */
    public static function capitalizeInData(mixed $data): String
    {
        //Inicializacion de la cadena
        $string = "";

        /**
         * Ejecucion en caso de que la entrada sea un array (Lista de palabras)
        */
        if(is_array($data))
        {
            foreach($data as $word){

                if(end($data) == $word){
                    $string .= self::capitalize($word);
                }else{
                    $string .= self::capitalize($word)." ";
                }
            }

            return $string;
        }

        /**
         * Ejecucion en caso de que la entrada sea un objeto (Modelo)
        */
        if($data instanceof User)
        {
            $string .= self::capitalize($data->names) . " " . self::capitalize($data->surnames);
        }

        /**
         * Retorno null en caso de que la entrada no sea un array o un objeto
        */
        return null;
    }
}