{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Lista de Marcas')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Lista de Marcas</h1>

        @can('inventory.create')
            <a class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded w-full md:w-auto" href="{{route("inventory.brands.create")}}" role="button">
                <i class="fa-solid fa-plus"></i>
                Crear
            </a>
        @endcan
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

    <div class="text-center">

        {{-- Visualizacion de mensajes --}}
        @include('components.alert')

        {{-- Tabla de datos --}}
        <table class="table table-striped table-bordered">
        
            {{-- Cabecera de la tabla --}}
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Productos registrados</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                @forelse ($brands as $brand)
                    <tr>
                        <td class="align-middle">{{$brand->name}}</td>
                        <td class="align-middle">{{$brand->products->count()}}</td>
                        <td>
                            <div class="flex justify-center gap-2 w-full">
                                <div class="button-tooltip" data-tooltip="Editar marca">
                                    <a class="btn btn-warning" href="{{route('inventory.brands.edit', $brand->slug)}}" role="button">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>
                                <form action="{{route('inventory.brands.destroy', $brand->slug)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="button-tooltip" data-tooltip="Eliminar marca">
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
        <div class="flex justify-center mb-3">{{ $brands->links('pagination::tailwind') }}</div>
    </div>

@endsection