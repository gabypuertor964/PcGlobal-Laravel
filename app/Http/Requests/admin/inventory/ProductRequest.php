<?php

namespace App\Http\Requests\admin\inventory;

use App\Helpers\CleanInputs;
use App\Helpers\RolesManager;
use App\Helpers\Validator;
use App\Http\Controllers\admin\inventory\ProductsController;
use App\Rules\ValidateMinResolution;
use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
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
        //Obtener el id del producto (si existe)
        if($this->routeIs('inventory.products.store')) {
            $id = null;
        }else{
            $id = ProductsController::get($this->route('product'))->id;
        }

        $rules = [
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'name' => 'required|string|max:255|unique:products,name,'.$id,
            'price' => 'required|numeric|min:1000',
            'stock' => 'required|integer|min:1',
            'description' => 'required|string|max:1000|min:1',
        ];

        //Si se esta actualizando el producto, se debe validar que la imagen sea opcional
        if($this->routeIs('inventory.products.store')) {
            $rules['images'] = [
                'required',
                'array',
            ];
            
            $rules['images.*'] = [
                'required',
                'image',
                'mimes:jpeg,png,jpg,svg,.wepb,.jfif',
                new ValidateMinResolution(1920, 1080)
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
            'category_id.required' => 'El campo categoría es obligatorio.',
            'category_id.integer' => 'El campo categoría debe ser un número entero.',
            'category_id.exists' => 'La categoría seleccionada no existe.',

            'brand_id.required' => 'El campo marca es obligatorio.',
            'brand_id.integer' => 'El campo marca debe ser un número entero.',
            'brand_id.exists' => 'La marca seleccionada no existe.',

            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no debe superar los 255 caracteres.',
            'name.unique' => 'El nombre del producto ya existe.',

            'price.required' => 'El campo precio es obligatorio.',
            'price.numeric' => 'El campo precio debe ser un número.',
            'price.min' => 'El precio del producto no puede ser menor a $1000.',

            'stock.required' => 'El campo stock es obligatorio.',
            'stock.integer' => 'El campo stock debe ser un número entero.',
            'stock.min' => 'El stock del producto no puede ser menor a 1.',

            'description.required' => 'El campo descripción es obligatorio.',
            'description.string' => 'El campo descripción debe ser una cadena de texto.',
            'description.max' => 'El campo descripción no debe superar los 1000 caracteres.',
            'description.min' => 'El campo descripción debe tener al menos 1 caracter.',

            'photo.required' => 'El campo imagen es obligatorio.',
            'photo.image' => 'El campo imagen debe ser una imagen.',
            'photo.mimes' => 'El campo imagen debe ser de tipo: jpeg, png, jpg, svg.',
            'photo.max' => 'El tamaño de la imagen no debe superar los 3MB.',
        ];
    }
}
