<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * @abstract Validador de entradas de texto
*/
class Validator{

    /**
     * @abstract Ejecutar las validaciones y retornar una unico valor de validacion
     * 
     * @param ?String $input
     * @return bool
    */
    public static function run(?String $input): bool
    {
        return self::isEmpty($input) &&
               self::isNotOnlySpaces($input) &&
               self::isNotMalicious($input);
    }

    /**
     * @abstract Ejecutar las validaciones en un listado de registros y retornar una unico valor de validacion
     * 
     * @param Array $list
     * @return bool
    */
    public static function runInList(Array $list): bool
    {
        foreach($list as $item){
            if(!self::run($item)){
                return false;
            }
        }
        return true;
    }

    /**
     * @abstract Ejecutar las validaciones en los datos de una request y retornar una unico valor de validacion
     * 
     * @param Request $request
     * @param Array $search Listado de campos a buscar
     * @param Array|null $exclution Listado de campos a exonerar de la validacion
     * 
     * @return bool
    */
    public static function runInRequest(Request $request,Array $search,Array $exclution = []): bool
    {
        foreach($search as $item){
            if(in_array($item,$search) && !in_array($item,$exclution)){
                if(!self::run($request->$item)){
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @abstract Verificar si la cadena está completamente vacía (sin caracteres)
     * 
     * @param ?String $input
     * @return bool
    */
    public static function isEmpty(?String $input): bool
    {
        return trim($input) !== '';
    }

    /**
     * @abstract Verificar que la cadena no este formada solo por espacios en blanco
     * 
     * @param ?String $input
     * @return bool
    */
    public static function isNotOnlySpaces(?String $input): bool
    {
        return !ctype_space($input);
    }

    /**
     * @abstract Verificar que la cadena no sea maliciosa
     * 
     * @param ?String $input
     * @return bool
    */
    public static function isNotMalicious(?String $input): bool
    {
        /**
         * Convertir caracteres especiales en entidades HTML 
         * Evitar ataques tipo Cross-Site Scripting (XSS)
        */
        $sanitizedInput = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        // Eliminar etiquetas HTML y PHP de la cadena
        $strippedInput = strip_tags($sanitizedInput); 
    
        // Listado de patrones de cadenas maliciosas
        $maliciousPatterns = ['/script/', '/on\w*=/i', '/<\s*iframe/i'];
    
        // Itera sobre los patrones y verifica si alguno coincide con el contenido
        foreach ($maliciousPatterns as $pattern) {
            if (preg_match($pattern, $strippedInput)) {

                // Si se encuentra una coincidencia, se considera que la cadena es maliciosa
                return false;
            }
        }
    
        return true;
    }

    /**
     * @abstract Verificar si una imagen publica existe
     * 
     * @return bool
    */
    public static function publicImageExist($directory,$default = "storage/others/default-image.png"): String 
    {
        if(File::exists(public_path($directory))){
            return asset($directory);
        }else{
            return asset($default);
        }
    }
}