{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Ver Marca')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Ver Marca</h1>
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

    <div class="text-center edit-form">
        {{-- Campo: Nombre --}}
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control text-center" value="{{$brand->name}}" disabled/>
        </div>

        <div class="flex justify-center gap-4">
            {{-- Boton: Volver --}}
            <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Volver a marcas">
                <a class="btn btn-primary col-12" href="{{route("inventory.brands.index")}}" role="button">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
    
@endsection