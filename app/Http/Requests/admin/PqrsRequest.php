<?php

namespace App\Http\Requests\admin;

use App\Helpers\RolesManager;
use Illuminate\Foundation\Http\FormRequest;

class PqrsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * Usuarios autorizados: gestor_pqrs, cliente
        */
        if(RolesManager::getRoles() == "gestor_pqrs" || RolesManager::getRoles() == "cliente")
        {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "response" => "required|string|max:500|min:1",
        ];
    }

    public function messages()
    {
        return [
            'response.required' => 'El campo de respuesta es obligatorio.',
            'response.string' => 'El campo de respuesta debe ser una cadena de texto.',
            'response.max' => 'El campo de respuesta no puede exceder los 500 caracteres.',
            'response.min' => 'El campo de respuesta debe tener al menos 1 caracter.',
        ];
    }


}
