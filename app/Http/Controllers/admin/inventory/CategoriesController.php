<?php

namespace App\Http\Controllers\admin\inventory;

use App\Helpers\SlugManager;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @abstract Consultar y mostrar la lista de categorias
     */
    public function index()
    {
        //Datos a consultar
        $categories = Category::paginate(11);

        //Encriptar los slugs de forma temporal
        foreach($categories as $category){
            $category->slug = SlugManager::encrypt($category->slug);
        }

        //Retornar la vista con la informacion
        return view('admin.inventory.categories.index', compact('categories'));
    }

    /**
     * @abstract Retorna la vista para crear una nueva categoria
     */
    public function create()
    {
        return view('admin.inventory.categories.create');
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
