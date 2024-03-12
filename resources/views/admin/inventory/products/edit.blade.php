{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Editar Producto')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Editar Producto</h1>
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
    
    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Product Image" style="max-width: 100%;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    

    {{-- Formulario --}}
    <form action="{{route("inventory.products.update",$product->slug_encrypt)}}" method="post" enctype="multipart/form-data">

        {{-- Token de seguridad --}}
        @csrf

        {{-- Metodo --}}
        @method('PUT')

        {{-- Inputs --}}
        <div class="block space-y-3 md:grid grid-cols-2 grid-rows-2 md:gap-3 md:space-y-0 mb-3">
            <div class="edit-form min-w-full row-span-2">
                {{-- Select: Categoria --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select class="form-select form-select" name="category_id">
                        <option disabled selected class="fw-bold">Seleccione</option>
                        
                        @foreach ($categories as $category)
                            @if (old('category_id', $product->category_id) == $category->id)
                                <div class="option-custom">
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                </div>    
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Select: Marca --}}
                <div class="mb-3">
                    <label for="brand_id" class="form-label">Marca</label>
                    <select class="form-select form-select" name="brand_id">
                        <option disabled selected class="fw-bold">Seleccione</option>
                        
                        @foreach ($brands as $brand)
                            @if (old('brand_id', $product->brand_id) == $brand->id)
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
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name', $product->name)}}" min="1" max="255" required/>
                </div>

                {{-- Input: Precio Unitario --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Precio Unitario</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{old('price', $product->price)}}" min="1000" required/>
                </div>

                {{-- Input: Stock disponible --}}
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" value="{{old('stock', $product->stock)}}" min="1" required/>
                </div>
            </div>

            {{-- Input: Foto --}}
            <div style="max-height: 275px; overflow-y: scroll;">
                <div class="p-3 card min-h-full">

                    {{-- Titulo Card --}}
                    <div class="card-header font-weight-bold font-italic text-center">
                        Imágenes del producto
                    </div>

                    {{-- Envio dinamico de imagenes --}}
                    <div class="card-body flex justify-center">
                        <!-- Agregar estos elementos ocultos en tu formulario Blade -->
                        <input type="hidden" id="existing-images" name="existing_images[]" value="">
                        <input type="hidden" id="new-images" name="new_images" value="">


                        <table class="col-12">
                            <tbody id="image-rows">
                                @foreach ($product->directory_images as $imageUrl)
                                    <tr class="image-row">
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-image="{{ asset("storage/products/{$product->slug}/images/{$imageUrl}") }}">Ver imagen</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger" onclick="removeImageRow(this)">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-success" onclick="addImageRow()">Agregar Imagen</button>
                    </div>
                </div>
            </div>
            
            <div class="card min-h-full">
                {{-- Input: Descripcion del producto--}}
                <div class="p-3 text-center">
                    <div class="card-header font-weight-bold font-italic text-center">
                        Descripción del producto
                    </div>
                    <div class="card-body">
                        <textarea placeholder="A continuación describe el producto..." class="form-control" name="description" rows="3" maxlength="1000" minlength="1">{{$product->description}}</textarea>
                    </div>
                </div>
            </div>

            {{-- Especificaciones del producto --}}
            <div class="edit-form col-span-2 row-span-2 min-w-full">
                <div class="card-header font-weight-bold font-italic text-center">
                    Especificaciones del producto
                </div>
                <div class="card-body">
                    <table class="col-12">
                        <tbody id="specRegisters">
                            <tr class="specRegister">
                            
                                @forelse ($product->data_specs["specs"] as $key => $spec)
                                    {{-- Input: Clave --}}
                                    <td class="col-4 text-center">
                                        <input class="form-control form-control-sm" type="text" placeholder="Valor" name="key_specs[]" required value="{{$spec}}">
                                    </td>
                                
                                    {{-- Input: Valor --}}
                                    <td class="col-6 text-center">
                                        <input class="form-control form-control-sm" type="text" placeholder="Clave" name="value_specs[]" required value="{{$product->data_specs["values"][$key]}}">
                                    </td>
                                @empty
                                    {{-- Input: Clave --}}
                                    <td class="col-4 text-center">
                                        <input class="form-control form-control-sm" type="text" placeholder="Valor" name="key_specs[]" required>
                                    </td>
                                
                                    {{-- Input: Valor --}}
                                    <td class="col-6 text-center">
                                        <input class="form-control form-control-sm" type="text" placeholder="Clave" name="value_specs[]" required>
                                    </td>
                                @endforelse
                            
                                {{-- Botones --}}
                                <td class="text-center">
                                
                                    {{-- Boton añadir --}}
                                    <button type="button" class="btn btn-success btn-sm mr-2" onclick="addSpecRow()">
                                        <i class="fas fa-plus fa-xl"></i>
                                    </button>
                                
                                    {{-- Boton eliminar --}}
                                    <button type="button" class="btn btn-danger btn-sm d-none" onclick="removeSpecRow(this)">
                                        <i class="fas fa-trash fa-xl"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>              
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
    @vite([
        'resources/js/bootstrap.js',
    ])
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que disparó el modal
            var imageUrl = button.data('image'); // Extraer la URL de la imagen del atributo personalizado
    
            var modal = $(this);
            modal.find('.modal-body #modalImage').attr('src', imageUrl); // Actualizar el src de la imagen en el modal
        });
    </script>    
@endsection