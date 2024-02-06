<?php

namespace App\Http\Requests\admin\inventory;

use App\Helpers\GetRegister;
use App\Helpers\RolesManager;
use App\Rules\ValidateMinResolution;
use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //Obtener el id de la categoria (si existe)
        if($this->routeIs('inventory.categories.store')){
            $id = null;
        }else{
            $id = GetRegister::Get($this->route('category'), 'category')->id;
        }

        //Reglas estandar
        $rules = [
            'name' => 'required|string|max:255|min:1|unique:categories,name,'.$id,
        ];

        /**
         * Si la solicitud es de tipo POST, se agrega la regla de validación para la imagen
        */
        if($this->isMethod('POST')){
            $rules['photo'] = [
                'required',
                'image',
                'mimes:jpeg,png,jpg,svg',
                'max:2048',
                new ValidateMinResolution(1280, 720)
            ];
        }

        return $rules;
    }

    /**
     * @abstract Obtener los mensajes de error que se aplicarán a las reglas de validación.
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoria es requerido.',
            'name.string' => 'El nombre de la categoria debe ser un texto.',
            'name.max' => 'El nombre de la categoria no puede superar los 255 caracteres.',
            'name.min' => 'El nombre de la categoria debe tener al menos 1 caracter.',
            'name.unique' => 'El nombre de la categoria ya esta registrado.',
            
            'photo.required' => 'La imagen de la categoria es requerida.',
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.mimes' => 'El archivo debe ser una imagen de tipo: jpeg, png, jpg o svg.',
            'photo.max' => 'El archivo no puede superar los 2MB.',
        ];
    }
}
