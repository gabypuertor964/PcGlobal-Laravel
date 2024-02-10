<?php

namespace App\Http\Requests\admin\inventory;

use App\Helpers\CleanInputs;
use App\Helpers\GetRegister;
use App\Helpers\RolesManager;
use App\Helpers\Validator;
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
        if($this->routeIs('admin.products.store')) {
            $id = null;
        }else{
            $id = GetRegister::Get($this->route('product'), 'product')->id;
        }

        $rules = [
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id,'.$id,
            'name' => 'required|string|max:255|unique:products,name,'.$id,
              
        ];



        return $rules;
    }
}
