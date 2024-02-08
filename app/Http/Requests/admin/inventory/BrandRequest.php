<?php

namespace App\Http\Requests\admin\inventory;

use App\Helpers\CleanInputs;
use App\Helpers\GetRegister;
use App\Helpers\RolesManager;
use App\Helpers\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * @abstract Determinar si el usuario esta autorizado para realizar esta solicitud.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        if(RolesManager::verifyPermission(['inventory.create'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @abstract Alterar los valores de los campos
     * 
     * @return void
    */
    public function prepareForValidation()
    {
        if(Validator::run($this->input('name'))){
            $this->request->set('name', CleanInputs::capitalize($this->name));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //Obtener el id de la marca (si existe)
        if($this->isMethod('POST')){
            $id = null;
        }else{
            $id = GetRegister::Get($this->route('brand'), 'brand')->id;
        }

        return [
            'name' => 'required|string|max:255|min:1|unique:brands,name,'.$id,
        ];
    }

    /**
     * @abstract Obtener los mensajes de error que se aplicarán a las reglas de validación.
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la marca es requerido.',
            'name.string' => 'El nombre de la marca debe ser un texto.',
            'name.max' => 'El nombre de la marca no puede superar los 255 caracteres.',
            'name.min' => 'El nombre de la marca debe tener al menos 1 caracter.',
            'name.unique' => 'El nombre de la marca ya esta registrado.',
        ];
    }
}
