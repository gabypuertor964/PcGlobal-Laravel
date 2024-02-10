{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Lista de Productos')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Lista de Productos</h1>

        <a class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded w-full md:w-auto" href="{{route("inventory.products.create")}}" role="button">
            <i class="fa-solid fa-plus"></i>
            Crear
        </a>
    </div>
@stop

{{-- Declaración de dependencias adicionales --}}
@section('adminlte_css_pre')
    @vite([
        'resources/css/tailwind.css',
        'resources/js/font-awesome.js',
        'resources/css/admin.css'
    ])  
@endsection

{{-- Contenido principal --}}
@section('content')

    {{-- Visualizacion de mensajes --}}
    @include('components.alert')

    <div class="text-center">

        {{-- Tabla de datos --}}
        <table class="table table-striped table-bordered">
        
            {{-- Cabecera de la tabla --}}
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Unidades disponibles</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="align-middle">{{$product->name}}</td>
                        <td class="align-middle">{{$product->brand->name}}</td>
                        <td class="align-middle">{{$product->category->name}}</td>
                        <td class="align-middle">{{$product->stock}}</td>
                        <td>
                            <div class="flex justify-center gap-2 w-full">

                                {{-- Boton: Actualizar --}}
                                <div class="button-tooltip" data-tooltip="Editar categoría">
                                    <a class="btn btn-warning" href="{{route('inventory.products.edit', $product->slug)}}" role="button">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>

                                {{-- Formulario: Eliminar --}}
                                <form action="{{route('inventory.products.destroy', $product->slug)}}" method="POST">

                                    {{-- Token CSRF --}}
                                    @csrf

                                    {{-- Metodo de comunicacion --}}
                                    @method('delete')

                                    {{-- Boton: Eliminar --}}
                                    <div class="button-tooltip" data-tooltip="Eliminar categoría">
                                        <button type="submit" class="btn btn-danger w-full">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No hay productos disponibles</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{-- Paginacion --}}
        <div class="hidden sm:flex sm:justify-center">{{ $products->links('pagination::tailwind') }}</div>
    </div>
@endsection