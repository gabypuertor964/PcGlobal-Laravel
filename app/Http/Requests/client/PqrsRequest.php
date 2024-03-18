<?php

namespace App\Http\Requests\client;

use App\Helpers\RolesManager;
use Illuminate\Foundation\Http\FormRequest;

class PqrsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(RolesManager::hasRole("cliente")){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "pqrs_type_id" => "required|integer|exists:pqrs_types,id",
            "title" => "required|string|max:20|min:1",
            "description" => "required|string|min:1|max:500",
            "date_ocurrence" => "nullable|date|before_or_equal:today",
        ];
    }

    public function messages()
    {
        return [
            'pqrs_type_id.required' => 'El campo tipo de PQRS es obligatorio.',
            'pqrs_type_id.integer' => 'El tipo de PQRS debe ser un número entero.',
            'pqrs_type_id.exists' => 'El tipo de PQRS seleccionado no es válido.',

            'title.required' => 'El campo título es obligatorio.',
            'title.string' => 'El título debe ser una cadena de caracteres.',
            'title.max' => 'El título no debe superar los 50 caracteres.',
            'title.min' => 'El título debe tener al menos 1 caracter.',
            
            'description.required' => 'El campo descripción es obligatorio.',
            'description.string' => 'La descripción debe ser una cadena de caracteres.',
            'description.max' => 'La descripción no debe superar los 500 caracteres.',
            'description.min' => 'La descripción debe tener al menos 1 caracter.',
            
            'date_ocurrence.date' => 'La fecha de ocurrencia debe ser una fecha válida.',
            'date_ocurrence.before_or_equal' => 'La fecha de ocurrencia debe ser igual o anterior a hoy.',
        ];
    }


}
