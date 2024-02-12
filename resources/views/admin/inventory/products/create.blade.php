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

        {{-- Inputs --}}
        <div class="row">
            <div class="col">
                {{-- Select: Categoria --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select class="form-select form-select-sm" name="category_id">
                        <option selected class="fw-bold">Seleccione</option>
                        
                        @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Select: Marca --}}
                <div class="mb-3">
                    <label for="brand_id" class="form-label">Marca</label>
                    <select class="form-select form-select-sm" name="brand_id">
                        <option selected class="fw-bold">Seleccione</option>
                        
                        @foreach ($brands as $brand)
                            @if (old('brand_id') == $brand->id)
                                <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                            @else
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Input: Nombre/Modelo --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre / Modelo</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" min="1" max="255" required/>
                </div>

                {{-- Input: Precio Unitario --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Precio Unitario</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{old('price')}}" min="1000" required/>
                </div>

                {{-- Input: Stock disponible --}}
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" value="{{old('stock')}}" min="1" required/>
                </div>
            </div>

            {{-- Input: Foto --}}
            <div class="col">
                <div class="card">

                    {{-- Titulo Card --}}
                    <div class="card-header font-weight-bold font-italic text-center">
                        Imagenes del producto
                    </div>

                    {{-- Envio dinamico de imagenes --}}
                    <div class="card-body p-3 flex justify-center">
                        <table class="col-12">
                            <tbody id="registers">
                                <tr id="register">

                                    {{-- Input: Foto --}}
                                    <td class="col-9">
                                        <input class="form-control form-control-sm" type="file" name="images[]" required accept=".jpeg, .png, .jpg, .svg">
                                    </td>

                                    {{-- Botones --}}
                                    <td class="text-center p-0">

                                        {{-- Boton añadir --}}
                                        <button type="button" id="btnCreate" class="btn btn-success mr-2" onclick="addChildToParent('registers')">
                                            <i class="fas fa-plus fa-xl"></i>
                                        </button>

                                        {{-- Boton eliminar --}}
                                        <button type="button" id="btnDelete" class="btn btn-danger d-none" onclick="removeLastChild('registers')">
                                            <i class="fas fa-trash fa-xl"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input: Descripcion del producto--}}
        <div class="mb-3 text-center">
            <label for="description" class="form-label">Descripcion del producto</label>
            <textarea class="form-control" name="description" rows="3" maxlength="1000" minlength="1"></textarea>
        </div>

        {{-- Botones --}}
        <div class="text-center">
            {{-- Boton: Guardar --}}
            <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Confirmar creación">
                <button type="submit" class="btn btn-success col-12">
                    <i class="fa-solid fa-check"></i>
                </button>
            </div>

            {{-- Boton: Cancelar --}}
            <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Cancelar creación">
                <a class="btn btn-danger col-12" href="{{route("inventory.products.index")}}" role="button">
                    <i class="fa-solid fa-plus fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
                </a>
            </div>
        </div>
    </form>
    
@endsection

{{-- Importacion scripts --}}
@section('js')
    <script src="{{asset('resources/js/clone_row.js')}}"></script>
@endsection