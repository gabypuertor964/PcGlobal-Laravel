<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\inventory\ProductsController;
use App\Models\Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth","role:cliente"]);
    }

    /**
     * @abstract Consultar el carrito
    */
    public function checkout() {
        $user = auth()->user();
        $cartCount = Cart::count();
        if ($cartCount)  {
            $cartContent = Cart::content();
        }
        else{
            $cartContent = null;
        }

        
        return view('landing.cart.checkout', compact("cartCount", "cartContent", "user"));
    }

    /**
     * @abstract Añadir un producto al carrito
    */
    public function add(Request $request) {
        try
        {
            // Obtener el producto en base al slug
            $product = ProductsController::get($request->slug, false);

            // Validar que el producto asociado al slug exista
            if($product === null)
            {
                return redirect()->back()->with("success", "Producto no encontrado.");
            }

            // Reglas de validación
            $rules = 
            [
                'slug' => 'required|string|max:255|min:1|exists:products,slug',
                'qty' => 'required|integer|min:1|max:'.(string)$product->stock
            ];

            // Mensajes de validación para los campos
            $messages = [
                'slug.required' => 'El campo slug es obligatorio.',
                'slug.string' => 'El campo slug debe ser una cadena de caracteres.',
                'slug.max' => 'El campo slug no puede tener más de :max caracteres.',
                'slug.min' => 'El campo slug debe tener al menos :min caracteres.',
                'slug.exists' => 'El slug proporcionado no es válido.',


                'qty.required' => 'El campo cantidad es obligatorio.',
                'qty.integer' => 'El campo cantidad debe ser un número entero.',
                'qty.min' => 'La cantidad mínima permitida es :min.',
                'qty.max' => 'La cantidad máxima permitida es :max.'
            ];

            $validation = Validator::make([
                'slug' => $request->slug,
                'qty' => $request->qty,
            ],$rules, $messages);

            # Retornar los mensajes de error (si existen)
            if ($validation->fails()) {
                return redirect()->back()->with("success", $validation->errors()->first());
            }
            

            //Obtener el directoria de las imágenes
            $directoryImage = ProductsController::getImagesDirectory($product->slug);

            $canAddToCart = true;

            if (Cart::content() !== null) {
                foreach (Cart::content() as $cartProduct) {
                    if ($cartProduct->id === $product->id && ($cartProduct->qty + $request->qty) > $product->stock) {
                        $canAddToCart = false;
                        break;
                    }
                }
            }
            
            if ($canAddToCart) {
                Cart::add(
                    $product->id,
                    $product->name,
                    (int)$request->qty,
                    $product->price,
                    ["image" => $directoryImage[2], "slug" => $product->slug, "stock" => $product->stock]
                );
            } else {
                return redirect()->back()->with("success", "Cantidad máxima alcanzada.");
            }


            return redirect()->back()->with("success", "Producto agregado al carrito.");
        }
        catch(Exception $e)
        {
            return redirect()->back()->with("success", $e->getMessage());
        }
    }

    /**
     * @abstract Actualizar un producto dell carrito
    */
    public function update(Request $request) {
        try
        {
            // Obtener el producto en base al slug
            $product = ProductsController::get($request->slug, false);

            // Validar que el producto asociado al slug exista
            if($product === null)
            {
                return redirect()->back()->with("success", "Producto no encontrado.");
            }

            // Reglas de validación
            $rules = 
            [
                'slug' => 'required|string|max:255|min:1|exists:products,slug',
                'qty' => 'required|integer|min:1|max:'.(string)$product->stock
            ];

            // Mensajes de validación para los campos
            $messages = [
                'slug.required' => 'El campo slug es obligatorio.',
                'slug.string' => 'El campo slug debe ser una cadena de caracteres.',
                'slug.max' => 'El campo slug no puede tener más de :max caracteres.',
                'slug.min' => 'El campo slug debe tener al menos :min caracteres.',
                'slug.exists' => 'El slug proporcionado no es válido.',


                'qty.required' => 'El campo cantidad es obligatorio.',
                'qty.integer' => 'El campo cantidad debe ser un número entero.',
                'qty.min' => 'La cantidad mínima permitida es :min.',
                'qty.max' => 'La cantidad máxima permitida es :max.'
            ];

            $validation = Validator::make([
                'slug' => $request->slug,
                'qty' => $request->qty,
            ],$rules, $messages);

            # Retornar los mensajes de error (si existen)
            if ($validation->fails()) {
                return redirect()->back()->with("success", $validation->errors()->first());
            }

            $canAddToCart = true;

            if (Cart::content() !== null) {
                foreach (Cart::content() as $cartProduct) {
                    if ($cartProduct->id === $product->id && $request->qty > $product->stock) {
                        $canAddToCart = false;
                        break;
                    }
                }
            }
            
            if ($canAddToCart) {
                Cart::update($request->rowId, $request->qty);
            } else {
                return redirect()->back()->with("success", "Cantidad máxima alcanzada.");
            }


            return redirect()->back()->with("success", "Producto actualizado.");
        }
        catch(Exception $e)
        {
            return redirect()->back()->with("success", $e->getMessage());
        }
    }
    
    /**
     * @abstract Eliminar un producto del carrito
    */
    public function remove(Request $request) {
        Cart::remove($request->rowId);
        return redirect()->back()->with("success", "Producto eliminado");
    }

    /**
     * @abstract Vaciar el carrito
    */
    public function clear() {
        Cart::destroy();
        return redirect()->back()->with("success", "Carrito vaciado");
    }

    /**
     * @abstract Vaciar el carrito después de una compra
    */
    public function clearAfterPurchase() {
        Cart::destroy();
        return redirect()->route("index")->with("success", "¡Compra exitosa! Para ver más detalles sobre tu compra, por favor revisa tu historial de pedidos.");
    }

}
;