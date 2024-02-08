{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Crear Marca')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Crear Marca</h1>
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

    <div class="edit-form">
        {{-- Formulario --}}
        <form action="{{route("inventory.brands.store")}}" method="post">

            {{-- Token de seguridad --}}
            @csrf

            <div class="text-center">

                {{-- Campo: Nombre --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control text-center" name="name" id="name" value="{{old('name')}}" min="1" max="255" required/>
                </div>

                <div class="flex justify-center gap-4">
                    {{-- Boton: Guardar --}}
                    <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Confirmar creación">
                        <button type="submit" class="btn btn-success col-12">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
    
                    {{-- Boton: Cancelar --}}
                    <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Cancelar creación">
                        <a class="btn btn-danger col-12" href="{{route("inventory.brands.index")}}" role="button">
                            <i class="fa-solid fa-plus fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
@endsection