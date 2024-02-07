{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Actualizar Marca')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Actualizar Marca</h1>
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

    {{-- Formulario --}}
    <div class="edit-form">
        <form action="{{route("inventory.brands.update",$brand->slug)}}" method="post">

            {{-- Token de seguridad --}}
            @csrf
    
            {{-- Metodo PUT --}}
            @method('put')
    
            <div class="text-center">
    
                {{-- Campo: Nombre --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control text-center" name="name" id="name" value="{{$brand->name}}" min="1" max="255"/>
                </div>
    
                <div class="flex justify-center gap-4">
                    {{-- Boton: Guardar --}}
                    <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Confirmar actualización">
                        <button type="submit" class="btn btn-success col-12">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
    
                    {{-- Boton: Cancelar --}}
                    <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Cancelar actualización">
                        <a class="btn btn-danger col-12" href="{{route("inventory.brands.index")}}" role="button">
                            <i class="fa-solid fa-plus fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
@endsection

{{-- Importacion scripts --}}
@section('js')
    @vite([
        'resources/js/upper.js'
    ])
@endsection