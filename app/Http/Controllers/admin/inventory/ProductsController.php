<?php

namespace App\Http\Controllers\admin\inventory;

use App\Helpers\SlugManager;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * @abstract Muestra una lista de los productos
     */
    public function index()
    {
        //Obtener los productos y paginarlos
        $products = Product::paginate(10);

        //Encriptar temporalmente los slugs
        foreach ($products as $product) {
            $product->slug = SlugManager::encrypt($product->slug);
        }

        //Retornar la vista con los productos
        return view('admin.inventory.products.index', compact('products'));
    }

    /**
     * @abstract Muestra el formulario para crear un nuevo producto
     */
    public function create()
    {
        // Consultar la informacion solicitada
        $categories = Category::all();
        $brands = Brand::all();

        // Retornar la vista con la informacion solicitada
        return view('admin.inventory.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
