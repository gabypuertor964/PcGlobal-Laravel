{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Crear Producto')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Crear Producto</h1>
@stop

{{-- Declaración de dependencias adicionales --}}
@section('adminlte_css_pre')
    @vite([
        'resources/css/tailwind.css',
        'resources/js/font-awesome.js',
        'resources/css/admin.css',
        'resources/css/bootstrap.scss',
    ])  
@endsection

{{-- Contenido principal --}}
@section('content')

    {{-- Visualizacion de errores --}}
    @include('components.alert')

    {{-- Formulario --}}
    <form action="{{route("inventory.products.store")}}" method="post" enctype="multipart/form-data">

        {{-- Token de seguridad --}}
        @csrf

        <div class="text-center row">
            <div class="edit-form h-1/2 my-auto">
                <div class="row">
            
                    {{-- Input/Select: Categoria --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>

                            <select class="form-select form-select-sm" name="category_id" required>
                                <option selected>Seleccione</option>
                                
                                @foreach ($categories as $category)

                                    {{-- Seleccionar el valor anterior en caso de que la peticion haya sido rechazada --}}
                                    @if (old('category_id') == $category->id)
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Input/Select: Marca --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Marca</label>

                            <select class="form-select form-select-sm" name="brand_id" required>
                                <option selected>Seleccione</option>
                                
                                @foreach ($brands as $brand)

                                    {{-- Seleccionar el valor anterior en caso de que la peticion haya sido rechazada --}}
                                    @if (old('brand_id') == $brand->id)
                                        <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                    @else
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">

                    {{-- Input Nombre --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" required min="1" max="255"/>
                        </div>
                    </div>

                    {{-- Input Precio --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="price" required min="1000" max="99999999"/>
                        </div>
                    </div>

                    {{-- Input: Unidades --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="units" class="form-label">Unidades</label>
                            <input type="number" class="form-control" name="units" required min="1" max="9999999999"/>
                        </div>
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
        </div>
    </form>
    
@endsection

{{-- Importacion scripts --}}
@section('js')
    @vite([
        'resources/js/select_preview.js'
    ])
@endsection