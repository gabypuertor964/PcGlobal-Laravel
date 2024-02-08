{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Crear Categoria')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Crear Categoria</h1>
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
    <form action="{{route("inventory.categories.store")}}" method="post" enctype="multipart/form-data">

        {{-- Token de seguridad --}}
        @csrf

        <div class="text-center">
            <div class="row mb-3 gap-y-2">

                {{-- Input nombre y botones --}}
                <div class="edit-form h-1/2 my-auto">

                    {{-- Campo: Nombre --}}
                    <div class="mb-3">
                        <div>
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control text-center col-12" name="name" id="name" value="{{old('name')}}" min="1" max="255" required/>
                        </div>
                    </div>

                    {{-- Boton: Guardar --}}
                    <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Confirmar creación">
                        <button type="submit" class="btn btn-success col-12">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>

                    {{-- Boton: Cancelar --}}
                    <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Cancelar creación">
                        <a class="btn btn-danger col-12" href="{{route("inventory.categories.index")}}" role="button">
                            <i class="fa-solid fa-plus fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
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
                            <input type="file" name="photo" id="photo" accept=".jpeg, .png, .jpg, .svg" class="d-none" required>

                            <img class="rounded" src="{{asset('storage/others/default-image.png')}}" style="width: 60%; height: 60%" id="photo_preview">
                        </div>

                        {{-- Boton de carga --}}
                        <div class="card-footer text-muted">
                            <button type="button" name="browse" id="browse" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded w-full">
                                Cargar imagen
                            </button>
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
        'resources/js/select_preview.js'
    ])
@endsection