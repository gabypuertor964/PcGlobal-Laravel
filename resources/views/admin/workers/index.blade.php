{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Lista de Empleados')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Lista de Empleados</h1>

        <a class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded w-full md:w-auto" href="{{route("admin.workers.create")}}" role="button">
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
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Género</th>
                    <th>Tipo de Documento</th>
                    <th>Número de Telefono</th>
                    <th>Correo Electrónico</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                @forelse ($workers as $worker)
                    <tr>
                        <td class="align-middle">{{$worker->names}}</td>
                        <td class="align-middle">{{$worker->surnames}}</td>
                        <td class="align-middle">{{$worker->gender->name}}</td>
                        <td class="align-middle">{{$worker->document_type->abbreviation}}</td>
                        <td class="align-middle">{{$worker->phone_number}}</td>
                        <td class="align-middle">{{$worker->email}}</td>
                        <td>
                            <div class="flex justify-center gap-2 w-full">

                                {{-- Boton: Actualizar --}}
                                <div class="button-tooltip" data-tooltip="Editar producto">
                                    <a class="btn btn-warning" href="{{route('admin.workers.edit', $worker->slug)}}" role="button">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>

                                {{-- Formulario: Eliminar --}}
                                <form action="{{ route("admin.workers.destroy", $worker->slug) }}" method="POST">

                                    {{-- Token CSRF --}}
                                    @csrf

                                    {{-- Metodo de comunicacion --}}
                                    @method('delete')

                                    {{-- Boton: Eliminar --}}
                                    <div class="button-tooltip" data-tooltip="Eliminar prodcuto">
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
                        <td colspan="5">No hay productos disponibles</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{-- Paginacion --}}
        <div class="hidden sm:flex sm:justify-center">{{ $workers->links('pagination::tailwind') }}</div>
    </div>
@endsection