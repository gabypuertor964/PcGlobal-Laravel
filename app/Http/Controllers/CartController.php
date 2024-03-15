<?php

namespace App\Http\Controllers;

use App\Http\Controllers\admin\inventory\ProductsController;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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
        // Obtener el producto en base al slug
        $product = Product::where('slug', $request->slug)->first();

        //Obtener el directoria de las imágenes
        $directoryImage = ProductsController::getImagesDirectory($product->slug);

        if(empty($product)) return redirect("/#categories");
        Cart::add(
            $product->id,
            $product->name,
            1,
            $product->price,
            ["image"=>$directoryImage[2], "slug" => $product->slug,],
        );

        return redirect()->back()->with("success", "Producto agregado: ". $product->name);
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

}
