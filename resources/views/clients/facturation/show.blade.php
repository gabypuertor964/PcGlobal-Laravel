{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Detalles Copra')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
    </div>
@stop

{{-- Declaración de dependencias adicionales --}}
@section('adminlte_css_pre')
    @vite([
        'resources/css/tailwind.css',
        'resources/js/font-awesome.js',
        'resources/css/admin.css',
        "resources/css/bootstrap.scss",
        "resources/js/bootstrap.js",
    ])  
@endsection

{{-- Contenido principal --}}
@section('content')

    {{-- Visualizacion de mensajes --}}
    @include('components.alert')

    {{-- Informacion basica --}}
    <div class="container align-middle text-center">

        {{-- Titulo Seccion --}}
        <div class="text-center">
            <h2>Informacion basica</h2>
        </div>

        {{-- Informacion --}}
        <div class="row">

            {{-- Transaccion --}}
            <div class="col">

                {{-- Fecha --}}
                <div class="text-center">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control text-center" value="{{$facturation->date}}" disabled/>
                </div>

                {{-- Hora --}}
                <div class="text-center">
                    <label class="form-label">Hora</label>
                    <input type="time" class="form-control text-center" value="{{$facturation->time}}" disabled/>
                </div>

            </div>

            {{-- Estado --}}
            <div class="col">
                <div class="text-center">
                    <label class="form-label">Estado</label>
                    <input type="text" class="form-control text-center" value="{{$facturation->state->name}}" disabled/>
                </div>
            </div>
    
        </div>
    </div>

    {{-- Detallado --}}
    <div class="container align-middle text-center mt-4">

        {{-- Titulo Seccion --}}
        <div class="text-center">
            <h2>Detallado</h2>
        </div>

        {{-- Listado de productos facturados --}}
        <table class="table table-striped table-bordered">
        
            {{-- Cabecera de la tabla --}}
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Nombre/Modelo</th>
                    <th>Cantidad</th>
                    <th>Valor Unitario</th>
                    <th>Valor Neto</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                @foreach ($facturation->details as $detail)
                    <tr>
                        <td class="align-middle">{{$detail->product->brand->name}}</td>
                        <td class="align-middle">{{$detail->product->name}}</td>
                        <td class="align-middle">{{$detail->quantity}}</td>
                        <td class="align-middle">${{number_format($detail->unit_price, 0, ',', '.')}}</td>
                        <td class="align-middle">${{number_format(($detail->unit_price * $detail->quantity), 0, ',', '.')}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    {{-- Resumen --}}
    <div class="container align-middle text-center w-auto mt-4">

        {{-- Listado de productos facturados --}}
        <table class="table table-bordered">

            {{-- Subtotal de la factura --}}
            <tr>
                <td class="align-middle fw-bolder">Subtotal</td>
                <td class="align-middle">${{number_format($facturation->subtotal, 0, ',', '.')}}</td>
            </tr>

            {{-- Impuestos --}}
            <tr>
                <td class="align-middle fw-bolder">Impuestos ({{$facturation->tax_percentage}}%)</td>
                <td class="align-middle">${{number_format($facturation->taxes, 0, ',', '.')}}</td>
            </tr>

            {{-- Total de la factura --}}
            <tr>
                <td class="align-middle fw-bolder">Total</td>
                <td class="align-middle fw-bolder">${{number_format($facturation->total, 0, ',', '.')}}</td>
            </tr>

        </table>
        
    </div>

    {{-- Boton: Volver --}}
    <div class="text-center">
        <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Volver a la vista anterior">
            <a class="btn btn-primary col-12" href="{{route("clients.facturation.index")}}" role="button">
                Volver al listado
            </a>
        </div>
    </div>

@endsection