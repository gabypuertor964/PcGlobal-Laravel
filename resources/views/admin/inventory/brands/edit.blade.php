{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Actualizar Marca')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Actualizar Marca</h1>
@stop

{{-- Contenido principal --}}
@section('content')

    {{-- Visualizacion de errores --}}
    @include('components.alert')

    {{-- Formulario --}}
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

            <div class="row">
                {{-- Boton: Guardar --}}
                <div class="col">
                    <button type="submit" class="btn btn-success col-12">Actualizar</button>
                </div>

                {{-- Boton: Cancelar --}}
                <div class="col">
                    <a class="btn btn-danger col-12" href="{{route("inventory.brands.index")}}" role="button">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
    
@endsection

{{-- Importacion scripts --}}
@section('js')
    @vite([
        'resources/js/upper.js'
    ])
@endsection