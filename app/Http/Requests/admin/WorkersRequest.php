<?php

namespace App\Http\Requests\admin;

use App\Helpers\CleanInputs;
use App\Helpers\RolesManager;
use App\Helpers\Validator;
use App\Http\Controllers\admin\WorkersController;
use App\Rules\UniqueFullName;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class WorkersRequest extends FormRequest
{
    /**
     * Usuarios autorizados: gerente
     */
    public function authorize(): bool
    {
        return RolesManager::hasRole("gerente");
    }

    /**
     * @abstract Alterar los valores de los campos
     * 
     * @return void
    */
    public function prepareForValidation()
    {
        if(Validator::runInList([
            $this->input('names'),
            $this->input('surnames'),
            $this->input('email')
        ])){
            $this->request->set('names', CleanInputs::runUpper($this->names));
            $this->request->set('surnames', CleanInputs::runUpper($this->surnames));
            $this->request->set('email', CleanInputs::runLower($this->email));
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        # Obtener el id del usuario (si existe)
        if($this->isMethod('POST')){
            $id = null;
        }else{
            $id = WorkersController::get($this->route('worker'))->id;
        }

        # Lista de roles no autorizados para el registro
        $data = [];

        # Obtener los roles no autorizados
        array_push($data, Role::where('name', 'cliente')->first()->id);
        array_push($data, Role::where('name', 'gerente')->first()->id);        

        $rules = [
            'names' => 'required|string|max:255|min:1',
            'surnames' => 'required|string|max:255|min:1',

            # Validar que el nombre completo no exista
            'surnames' => new UniqueFullName($this->names,$this->surnames,$id),

            'gender_id' => 'required|int|exists:genders,id',
            'document_type_id' => 'required|int|exists:document_types,id',
            'document_number' => 'required|int|min:1|max:9999999999|unique:users,document_number,'.$id,
            'phone_number' => 'required|int||min:1|max:9999999999|unique:users,phone_number,'.$id,

            'date_birth' => [
                'required',
                'date',
                'before:'.now()->subYear(18)->format('Y-m-d'),
                'after:'. now()->subYear(100)->format('Y-m-d')
            ],

            'email' => 'required|string|email|unique:users,email,'.$id,
            'role_id' => 'required|int|exists:roles,id|not_in:'.implode(',',$data),
        ];

        # Reglas para la contraseña (Segun el metodo de la peticion)
        if ($this->isMethod('PUT')) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }else{
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }

    /**
     * Mensajes de error
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'names.required' => 'El nombre es obligatorio.',
            'names.string' => 'El nombre debe ser una cadena de caracteres.',
            'names.max' => 'El nombre no puede tener más de :max caracteres.',
            'names.min' => 'El nombre debe tener al menos :min caracteres.',

            'surnames.required' => 'Los apellidos son obligatorios.',
            'surnames.string' => 'Los apellidos deben ser una cadena de caracteres.',
            'surnames.max' => 'Los apellidos no pueden tener más de :max caracteres.',
            'surnames.min' => 'Los apellidos deben tener al menos :min caracteres.',

            'gender_id.required' => 'El género es obligatorio.',
            'gender_id.int' => 'El género debe ser un número entero.',
            'gender_id.exists' => 'El género seleccionado no es válido.',

            'document_type_id.required' => 'El tipo de documento es obligatorio.',
            'document_type_id.int' => 'El tipo de documento debe ser un número entero.',
            'document_type_id.exists' => 'El tipo de documento seleccionado no es válido.',

            'document_number.required' => 'El número de documento es obligatorio.',
            'document_number.int' => 'El número de documento debe ser un número entero.',
            'document_number.min' => 'El número de documento debe ser mayor que :min.',
            'document_number.max' => 'El número de documento no puede ser mayor que :max.',
            'document_number.unique' => 'El número de documento ya está registrado.',

            'phone_number.required' => 'El número de teléfono es obligatorio.',
            'phone_number.int' => 'El número de teléfono debe ser un número entero.',
            'phone_number.min' => 'El número de teléfono debe ser mayor que :min.',
            'phone_number.max' => 'El número de teléfono no puede ser mayor que :max.',
            'phone_number.unique' => 'El número de teléfono ya está registrado.',

            'date_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_birth.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'date_birth.before' => 'Debe ser mayor de 18 años para registrarse.',
            'date_birth.after' => 'La fecha de nacimiento debe ser válida.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser una cadena de caracteres.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',

            'role_id.required' => 'El rol es obligatorio.',
            'role_id.int' => 'El rol debe ser un número entero.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
            'role_id.not_in' => 'El rol seleccionado no es válido.'
        ];
    }
}
