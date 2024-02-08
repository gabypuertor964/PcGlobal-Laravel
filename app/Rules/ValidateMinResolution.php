<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateMinResolution implements ValidationRule
{
    /**
     * @var int El ancho mínimo requerido
     */
    private $minWidth;

    /**
     * @var int La altura mínima requerida
     */
    private $minHeight;

    /**
     * Crea una nueva instancia de la regla de validación.
     *
     * @param  int  $minWidth
     * @param  int  $minHeight
     * @return void
     */
    public function __construct(int $minWidth,int $minHeight)
    {
        $this->minWidth = $minWidth;
        $this->minHeight = $minHeight;
    }

    /**
     * Ejecuta la regla de validación.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            //Obtener tamaño de la imagen
            $imageSize = getimagesize($value);

            //Comprobacion altura de la imagen
            if ($imageSize[1] < $this->minHeight) {
                $fail("La altura de la imagen debe ser de al menos {$this->minHeight} pixles.");
            }

            //Comprobacion ancho de la imagen
            if ($imageSize[0] < $this->minWidth) {
                $fail("El ancho de la imagen debe ser de al menos {$this->minWidth} pixles.");
            }
        } catch (\Exception $e) {
            $fail("La imagen no es valida");
        }
    }
}
