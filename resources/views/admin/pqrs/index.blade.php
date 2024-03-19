{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', $title)

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">{{$title}}</h1>
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
                <th>Fecha y Hora</th>
                <th>Estado</th>
                <th>Cliente</th>
                <th class="hidden lg:table-cell">Empleado que respondió</th>
                <th class="hidden lg:table-cell">Título</th>
                <th>Acciones</th>
            </tr>
        </thead>

        {{-- Cuerpo de la tabla --}}
        <tbody>
            @forelse ($pqrs_s as $pqrs)
                <tr>
                    <td class="align-middle">{{$pqrs->created_at}}</td>
                    <td class="align-middle">{{$pqrs->state->name}}</td>
                    <td class="align-middle">{{$pqrs->client->fullName()}}</td>
                    @if ($pqrs->worker === null)
                        <td class="align-middle hidden lg:table-cell">N/A</td>
                    @else
                        <td class="align-middle hidden lg:table-cell">{{$pqrs->worker->fullName()}}</td>
                    @endif
                    <td class="align-middle hidden lg:table-cell">{{$pqrs->title}}</td>
                    <td>
                        <div class="flex justify-center gap-2 w-full">

                                {{-- Boton Ver --}}
                                <div class="button-tooltip" data-tooltip="Ver PQRS">
                                    <a class="btn btn-primary" href="{{route('admin.pqrs.show', $pqrs->slug)}}" role="button">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>

                                @if($pqrs->state->name === "Respondida")
                                @else
                                    {{-- Boton Editar --}}
                                    <div class="button-tooltip" data-tooltip="Editar PQRS">
                                        <a class="btn btn-warning" href="{{route('admin.pqrs.edit', $pqrs->slug)}}" role="button">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </div>
                                @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se han registrado PQRS</td>
                </tr>
            @endforelse
        </tbody>

    </table>

    {{-- Paginacion --}}
    <div class="flex justify-center mb-3">{{ $pqrs_s->links('pagination::tailwind') }}</div>
</div>

@endsection