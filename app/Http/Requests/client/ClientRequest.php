<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\GetRegister;
use App\Helpers\RolesManager;
use App\Rules\UniqueFullName;
use Exception;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * Acceso autorizado para usuarios no autenticados
        */
        if(auth()->guest())
        {
            return true;
        }

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
        /**
         * En caso de que el usuario no este autenticado, se asigna el valor null a la variable $id
        */
        if(auth()->guest())
        {
            $id = null;
        }

        /**
         * Origen de datos:
         * 
         * - Si el usuario es gestor_pqrs, se obtiene el id del cliente a traves del slug proveniende de la url
         * - Si el usuario es cliente, se obtiene el id del cliente a traves de la sesion
        */
        if(RolesManager::getRoles() == "gestor_pqrs"){

            try{
                $id = GetRegister::Get($this->slug);
            }catch(Exception){
                return abort(404, "El cliente no existe");
            }      

        }elseif(RolesManager::getRoles() == "cliente"){
            $id = auth()->user()->id;
        }

        /**
         * Reglas a ejecutar en caso de que la peticion sea de registro o actualizacion
        */
        $rules = [
            'names' => 'required|string',
            'surnames' => 'required|string',

            'surnames' => new UniqueFullName(
                $this->input('names'),
                $this->input('surnames'),
                $id
            ),

            'gender_id' => 'required|int|exists:genders,id',
            'document_type_id' => 'required|int|exists:document_types,id',
            'document_number' => 'required|int|min:1|max:9999999999|unique:users,document_number,'.$id,
            'phone_number' => 'required|int||min:1|max:9999999999|unique:users,phone_number,'.$id,

            'date_birth' => [
                'required',
                'date',
                'before:'.now()->subYear(18)->format('Y-m-d'),
                'after:'.now()->subYear(100)->format('Y-m-d')
            ],

            'email' => 'required|string|email|unique:users,email,'.$id,
            'password' => 'required|string|min:8|confirmed',
        ];

        return $rules;
    }

    /**
     * @abstract Mensajes personalizados para las reglas de validación
     * 
     * @return array<string, string>
    */
    public function messages()
    {
        return [
            'names.required' => 'El campo de nombres es obligatorio.',
            'names.string' => 'El campo de nombres debe ser una cadena de texto.',

            'surnames.required' => 'El campo de apellidos es obligatorio.',
            'surnames.string' => 'El campo de apellidos debe ser una cadena de texto.',

            'gender_id.required' => 'El campo de género es obligatorio.',
            'gender_id.int' => 'El campo de género debe ser un número entero.',
            'gender_id.exists' => 'El género seleccionado no es válido.',

            'document_type_id.required' => 'El campo de tipo de documento es obligatorio.',
            'document_type_id.int' => 'El campo de tipo de documento debe ser un número entero.',
            'document_type_id.exists' => 'El tipo de documento seleccionado no es válido.',

            'document_number.required' => 'El campo de número de documento es obligatorio.',
            'document_number.int' => 'El campo de número de documento debe ser un número entero.',
            'document_number.min' => 'El número de documento debe ser al menos :min.',
            'document_number.max' => 'El número de documento no puede ser mayor a :max.',
            'document_number.unique' => 'Este número de documento ya está registrado.',

            'phone_number.required' => 'El campo de número de teléfono es obligatorio.',
            'phone_number.int' => 'El campo de número de teléfono debe ser un número entero.',
            'phone_number.min' => 'El número de teléfono debe ser al menos :min.',
            'phone_number.max' => 'El número de teléfono no puede ser mayor a :max.',
            'phone_number.unique' => 'Este número de teléfono ya está registrado.',

            'date_birth.required' => 'El campo de fecha de nacimiento es obligatorio.',
            'date_birth.date' => 'El campo de fecha de nacimiento debe ser una fecha válida.',
            'date_birth.before' => 'El cliente debe haber nacido antes de :date.',
            'date_birth.after' => 'El cliente debe haber nacido después de :date.',

            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.string' => 'El campo de correo electrónico debe ser una cadena de texto.',
            'email.email' => 'El correo electrónico proporcionado no es válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.string' => 'El campo de contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
    }
}
