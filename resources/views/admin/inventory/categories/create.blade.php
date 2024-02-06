{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Crear Categoria')

{{-- Importacion Hojas de estilos --}}
@section('adminlte_css_pre')
    @vite([
        //'resources/css/app.css',
    ])
@endsection

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Crear Categoria</h1>
@stop

{{-- Contenido principal --}}
@section('content')

    {{-- Visualizacion de errores --}}
    @include('components.alert')

    {{-- Formulario --}}
    <form action="{{route("inventory.categories.store")}}" method="post" enctype="multipart/form-data">

        {{-- Token de seguridad --}}
        @csrf

        <div class="text-center">
            <div class="row mb-3">

                {{-- Input nombre y botones--}}
                <div class="col">

                    {{-- Input: Nombre --}}
                    <div class="row mb-3">
                        <div class="col">
                            <div>
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control text-center col-12" name="name" id="name" value="{{old('name')}}" min="1" max="255"/>
                            </div>
                        </div>
                    </div>

                    {{-- Boton: Guardar --}}
                    <div class="row mb-2">
                        <div class="col">
                            <button type="submit" class="btn btn-success col-12">Guardar</button>
                        </div>
                    </div>

                    {{-- Boton: Cancelar --}}
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-danger col-12" href="{{route("inventory.categories.index")}}" role="button">Cancelar</a>
                        </div>
                    </div>
                </div>

                {{-- Input: Foto --}}
                <div class="col">
                    <div class="card">

                        {{-- Titulo Card --}}
                        <div class="card-header font-weight-bold font-italic">Imagen de referencia</div>

                        {{-- Visualizador de foto --}}
                        <div class="card-body p-3">
                            <input type="file" name="photo" id="photo" accept=".jpeg, .png, .jpg, .svg" class="d-none" required>

                            <img src="https://cdn-icons-png.flaticon.com/512/3843/3843517.png" style="width: 60%; height: 60%" id="photo_preview">
                        </div>

                        {{-- Boton de carga --}}
                        <div class="card-footer text-muted">
                            <button type="button" name="browse" id="browse" class="btn btn-primary btn-sm col-12"">Cargar imagen</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    
@endsection

{{-- Importacion scripts --}}
@section('js')
    @vite([
        'resources/js/upper.js',
        'resources/js/select_preview.js'
    ])
@endsection