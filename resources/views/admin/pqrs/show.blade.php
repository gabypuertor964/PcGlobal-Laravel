{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Ver PQRS')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Ver PQRS</h1>
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

    {{-- Visualizacion de errores --}}
    @include('components.alert')
    {{-- Card de la factura --}}
    <div class="bg-white shadow-md invoice-card">
        {{-- Título: Información básica --}}
        <p class="text-lg text-center border-b w-fit mx-auto mt-3">Información básica</p>

        {{-- Apartado: Información básica --}}
        <div class="invoice-card-content basics">
            <ul class="list-none">
                {{-- Título --}}
                <li>
                    <span class="font-semibold">Título: </span> 
                    {{$pqrs->title}}
                </li>
                
                {{-- Típo de PQRS --}}
                <li>
                    <span class="font-semibold">Típo de PQRS: </span> 
                    {{$pqrs->type->name}}
                </li>
                
                {{-- Fecha y hora --}}
                <li>
                    <span class="font-semibold">Fecha y hora: </span> 
                    {{$pqrs->created_at}}
                </li>

                {{-- Fecha y hora Ocurrencia --}}
                <li>
                    <span class="font-semibold">Fecha y hora (Ocurrencia): </span> 
                    @if ($pqrs->date_ocurrence === null)
                        N/A
                    @else
                        {{$pqrs->date_ocurrence}}
                    @endif
                </li>

                {{-- Estado --}}
                <li>
                    <span class="font-semibold">Estado: </span> 
                    {{$pqrs->state->name}}
                </li>
            </ul>
        </div>

        {{-- Título: Información básica --}}
        <p class="text-lg text-center border-b w-fit mx-auto mt-3">Más información</p>

        {{-- Apartado: Información del cliente --}}
        <div class="invoice-card-content basics grid grid-cols-1 lg:grid-cols-3 text-center">

            
            {{-- Nombres del cliente --}}
            <p class="flex flex-col">
                <span class="font-semibold">Nombres del cliente:</span> 
                {{$pqrs->client->fullName()}}
            </p>

            {{-- Descripción de la PQRS --}}
            <p class="flex flex-col">
                <span class="font-semibold">Descripción:</span> 
                {{$pqrs->description}}
            </p>

            @if($pqrs->worker === null)
                {{-- Nombres del trabajador --}}
                <p class="flex flex-col">
                    <span class="font-semibold">Nombres del empleado que respondió:</span> 
                    <span class="font-semibold">N/A</span>
                    (La PQRS aún no ha sido respondida) 
                </p>
            @else
                {{-- Nombres del trabajador --}}
                <p class="flex flex-col">
                    <span class="font-semibold">Nombres del empleado que respondió:</span> 
                    {{$pqrs->client->fullName()}}
                </p>
            @endif

            {{-- Respuesta --}}
            @if ($pqrs->response === null)
                <p class="flex flex-col col-span-1 lg:col-span-3">
                    <span class="font-semibold">Respuesta:</span> 
                    <span class="font-semibold">N/A</span>
                    Aún no hay una respuesta
                </p>
            @else
                <p class="flex flex-col col-span-1 lg:col-span-3">
                    <span class="font-semibold">Respuesta:</span> 
                    {{ $pqrs->response }}
                </p>
            @endif
            
        </div>        

        {{-- Título: Detalles --}}
        {{-- <p class="text-lg text-center border-b w-fit mx-auto mt-3">Detalles</p> --}}

        {{-- Boton: Volver --}}
        <div class="text-center mt-3">
            <div class="button-tooltip w-full lg:w-1/3" data-tooltip="Volver al listado de los PQRS">
                <a class="btn btn-primary col-12" href="{{route("admin.pqrs.index")}}" role="button">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
    
@endsection