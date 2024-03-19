{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Mis PQRS')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Mis PQRS</h1>

        @can('client.create')
            <a class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded w-full md:w-auto" href="{{route("clients.pqrs.create")}}" role="button">
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

    {{-- Visualizacion de mensajes --}}
    @include('components.alert')

    <div class="text-center">

        {{-- Tabla de datos --}}
        <table class="table table-striped table-bordered">
        
            {{-- Cabecera de la tabla --}}
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th class="hidden lg:table-cell">Hora</th>
                    <th>Estado</th>
                    <th>Titulo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                @forelse ($pqrs_s as $pqrs)
                    <tr>
                        <td class="align-middle col-1">{{$pqrs->datetime["date"]}}</td>
                        <td class="align-middle col-1 hidden lg:table-cell">{{$pqrs->datetime["time"]}} (UTC-5)</td>
                        <td class="align-middle col-1">{{$pqrs->state->name}}</td>
                        <td class="align-middle col-5">{{$pqrs->title}}</td>        
                        <td class="col-1">
                            <div class="flex justify-center gap-2 w-full">

                                {{-- Boton: Actualizar --}}
                                <div class="button-tooltip" data-tooltip="Editar producto">
                                    <a class="btn btn-warning" href="{{route('clients.pqrs.edit', $pqrs->slug)}}" role="button">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>

                                {{-- Formulario: Eliminar --}}
                                <form action="{{route('clients.pqrs.destroy', $pqrs->slug)}}" method="POST">

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
                        <td colspan="5">
                            Aún no has realizado ninguna PQRS.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{-- Paginacion --}}
        <div class="hidden sm:flex sm:justify-center">{{ $pqrs_s ->links('pagination::tailwind') }}</div>
    </div>
@endsection