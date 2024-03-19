{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Ver Producto')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Ver Producto</h1>
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
    
    {{-- Modal --}}
    {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>--}}
    
    {{-- Inputs --}}
    <div class="block space-y-3 md:grid grid-cols-2 grid-rows-2 md:gap-3 md:space-y-0 mb-3">
        
        <div class="edit-form min-w-full row-span-2">
            
            {{-- Select: Categoria --}}
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input type="text" class="form-control" value="{{$product->category->name}}" disabled/>
            </div>

            {{-- Select: Marca --}}
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" class="form-control" value="{{$product->brand->name}}" disabled/>
            </div>

            {{-- Input: Nombre/Modelo --}}
            <div class="mb-3">
                <label class="form-label">Nombre / Modelo</label>
                <input type="text" class="form-control" value="{{$product->name}}" disabled/>
            </div>

            {{-- Input: Precio Unitario --}}
            <div class="mb-3">
                <label class="form-label">Precio Unitario</label>
                <input type="text" class="form-control" value="${{number_format($product->price, 0, ',', '.')}}" disabled/>
            </div>

            {{-- Input: Stock disponible --}}
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="text" class="form-control" value="{{$product->stock}}" disabled/>
            </div>
        </div>

        {{-- Input: Foto --}}
        <div class="row-span-2">
            <div class="p-3 card min-h-full">

                {{-- Titulo Card --}}
                <div class="card-header font-weight-bold font-italic text-center">
                    Imagen del producto
                </div>

                {{-- Envio dinamico de imagenes --}}
                <div class="card-body flex justify-center">
                    <img src="{{asset($product->image_route)}}" class="img-student size-image-form" id="photo_preview" alt="Imagen del producto {{$product->model}}">
                </div>
            </div>
        </div>
        
        {{-- Input: Descripcion del producto--}}
        <div class="card min-h-full row-span-2">
            <div class="p-3 text-center">
                <div class="card-header font-weight-bold font-italic text-center">
                    Descripción del producto
                </div>
                <div class="card-body">
                    <textarea disabled class="form-control">{{$product->description}}</textarea>
                </div>
            </div>
        </div>

        {{-- Especificaciones del producto --}}
        <div class="edit-form row-span-2 min-w-full">
            <div class="card-header font-weight-bold font-italic text-center">
                Especificaciones del producto
            </div>
            <div class="card-body">
                <table class="col-12">
                    <tbody id="specRegisters">
                        @foreach ($product->data_specs["specs"] as $key => $spec)
                            <tr class="specRegister">
                                {{-- Input: Clave --}}
                                <td class="col-4 text-center">
                                    <input class="form-control form-control-sm" type="text" disabled value="{{$product->data_specs["values"][$key]}}">
                                </td>
                                
                                {{-- Input: Valor --}}
                                <td class="col-6 text-center">
                                    <input class="form-control form-control-sm" type="text" disabled value="{{$product->data_specs["values"][$key]}}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>              
    </div>

    {{-- Botones --}}
    <div class="text-center">
        {{-- Boton: Volver --}}
        <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Volver a la vista anterior">
            <a class="btn btn-primary col-12" href="{{route("inventory.products.index")}}" role="button">
                Volver al listado
            </a>
        </div>
    </div>
@endsection