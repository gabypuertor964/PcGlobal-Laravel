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
     * @param ?String $text
     * @return String
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
        /**
         * Ejecucion en caso de que la entrada sea un array (Lista de palabras)
        */
        if(is_array($data)){
            $string = "";

            foreach($data as $word){
                $string .= self::capitalize($word)." ";
            }

            return $string;
        }

        /**
         * Ejecucion en caso de que la entrada sea un objeto (Modelo autorizado)
        */
        if($data instanceof User)
        {
            //Concatenacion primer nombre
            $fullname = self::capitalize($data->first_name);

            /* Validar si se debe o no concatenar el campo segundo nombre */
            if($data->second_name != null){
                $fullname .= " " . self::capitalize($data->second_name);
            }

            //Concatenacion apellidos
            $fullname .= " " . self::capitalize($data->first_surname) . " " . self::capitalize($data->second_surname);

            return $fullname;
        }

        /**
         * Retorno null en caso de que la entrada no sea un array o un objeto
        */
        return null;
    }

    /**
     * @abstract Convertir una lista de palabras en una cadena con la primera letra de cada palabra en mayuscula
     * 
     * @param mixed $model
     * @return String
    */
    public static function buildFullName(mixed $model){

        //Concatenacion primer nombre
        $fullname = $model->first_name;

        /* Validar si se debe o no concatenar el campo segundo nombre */
        if($model->second_name != null){
            $fullname .= " " . $model->second_name;
        }

        //Concatenacion apellidos
        $fullname .= " " . $model->first_surname . " " . $model->second_surname;

        return $fullname;
    }
}