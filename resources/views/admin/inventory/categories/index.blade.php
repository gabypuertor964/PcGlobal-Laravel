{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Lista de Categorias')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Lista de Marcas</h1>

        <a class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded w-full md:w-auto" href="{{route("inventory.brands.create")}}" role="button">
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
                    <th>Productos Asociados</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="align-middle">{{$category->name}}</td>
                        <td class="align-middle">{{$category->products->count()}}</td>
                        <td>
                            <div class="flex justify-center gap-2 w-full">
                                <div class="button-tooltip" data-tooltip="Editar categoría">
                                    <a class="btn btn-warning" href="{{route('inventory.brands.edit', $category->slug)}}" role="button">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>
                                <form action="{{route('inventory.categories.destroy', $category->slug)}}" method="POST">
                                    @csrf
                                    @method('delete')
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
        <div class="hidden sm:flex sm:justify-center">{{ $categories->links('pagination::tailwind') }}</div>
    </div>
@endsection