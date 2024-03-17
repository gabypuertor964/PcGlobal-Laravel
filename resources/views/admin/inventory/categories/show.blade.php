{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Ver Categoria')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Ver Categoria</h1>
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

    <div class="text-center">
        <div class="row mb-3 gap-y-2">

            {{-- Input nombre y botones--}}
            <div class="edit-form h-1/2 my-auto">

                {{-- Input: Nombre --}}
                <div class="row mb-3">
                    <div class="col">
                        <div>
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control text-center col-12" value="{{$category->name}}" disabled/>
                        </div>
                    </div>
                </div>

                {{-- Boton: Volver --}}
                <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Volver a categorias">
                    <a class="btn btn-primary col-12" href="{{route("inventory.categories.index")}}" role="button">
                        Volver al listado
                    </a>
                </div>
            </div>

            {{-- Input: Foto --}}
            <div class="col">
                <div class="card">

                    {{-- Titulo Card --}}
                    <div class="card-header font-weight-bold font-italic">
                        Imagen de referencia
                    </div>

                    {{-- Visualizador de foto --}}
                    <div class="card-body p-3 flex justify-center">
                        <img class="rounded" src='{{$category->image}}' style="width: 60%; height: 60%" id="photo_preview">
                    </div>
                </div>
            </div>

        </div>
    </div>
    
@endsection