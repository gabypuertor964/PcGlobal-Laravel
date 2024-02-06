{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Lista de Marcas')

{{-- Titulo principal --}}
@section('content_header')
    <div class="d-flex justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Lista de Marcas</h1>

        <a class="btn btn-primary col-3" href="{{route("inventory.brands.create")}}" role="button">Crear</a>
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
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-warning col-12" href="{{route('inventory.brands.edit', $brand->slug)}}" role="button">Editar</a>
                                </div>
                                <div class="col">
                                    <form action="{{route('inventory.brands.destroy', $brand->slug)}}" method="POST">
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
        <div class="hidden sm:flex sm:justify-center">{{ $brands->links('pagination::tailwind') }}</div>
    </div>
@endsection