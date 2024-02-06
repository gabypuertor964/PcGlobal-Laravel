{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Lista de Categorias')

{{-- Titulo principal --}}
@section('content_header')
    <div class="d-flex justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Lista de Categorias</h1>

        <a class="btn btn-primary col-3" href="{{route("inventory.categories.create")}}" role="button">Crear</a>
    </div>
@stop

@section('adminlte_css_pre')
    @vite([
        'resources/css/tailwind.css',
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
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-warning col-12" href="{{route('inventory.categories.edit', $category->slug)}}" role="button">Editar</a>
                                </div>
                                <div class="col">
                                    <form action="{{route('inventory.categories.destroy', $category->slug)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger col-12">Eliminar</button>
                                    </form>
                                </div>
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