<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueFullName implements ValidationRule
{
    /**
     * Atributos a usar en la validacion
    */
    private $names;
    private $surnames;
    private $id;

    public function __construct(string $names, string $surnames,int $id = null)
    {
        $this->names = $names;
        $this->surnames = $surnames;
        $this->id = $id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /**
         * Validar la existencia del nombre y apellido (Sin exclusion segun id)
        */
        if(is_null($this->id)){
            if(User::where('names', $this->names)->where('surnames', $this->surnames)->exists()){
                $fail('El nombre y apellido ya se encuentran registrados');
            }

        /**
         * Validar la existencia del nombre y apellido (Con exclusion de id)
        */
        }else{
            if(User::where('names', $this->names)->where('surnames', $this->surnames)->where('id','!=',$this->id)->exists()){
                $fail('El nombre y apellido ya se encuentran registrados');
            }
        }

        
    }
}
