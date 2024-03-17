{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Registrar Entrega')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Registrar Entrega</h1>
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
            <h2>Informacion Básica</h2>
        </div>

        {{-- Fecha y hora de la transaccion --}}
        <table class="table table-striped table-bordered">

            {{-- Cabecera de la tabla --}}
            <thead>
                <tr>
                    <th colspan="2">Fecha y hora de la transaccion</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                <tr>
                    <td class="align-middle">{{$facturation->datetime["date"]}}</td>
                    <td class="align-middle">{{$facturation->datetime["time"]}} (UTC-5)</td>
                </tr>
            </tbody>
        </table>

    </div>

    {{-- Informacion del Cliente --}}
    <div class="container align-middle text-center">

        {{-- Titulo Seccion --}}
        <div class="text-center">
            <h2>Informacion del Cliente</h2>
        </div>

        {{-- Grupo 1--}}
        <div class="row">

            {{-- Nombre del cliente --}}
            <div class="mb-3 col-4">
                <label class="form-label">Nombres</label>
                <input type="text" class="form-control text-center" disabled value="{{ucfirst(strtolower($facturation->client->names))}}"/>
            </div>

            {{-- Apellidos del cliente --}}
            <div class="mb-3 col-4">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control text-center" disabled value="{{ucfirst(strtolower($facturation->client->surnames))}}"/>   
            </div>

            {{-- Sexo/Genero del cliente --}}
            <div class="mb-3 col-4">
                <label class="form-label">Genero/Sexo</label>
                <input type="text" class="form-control text-center" disabled value="{{$facturation->client->gender->name}}"/>
            </div>
        </div>

        {{-- Grupo 2 --}}
        <div class="row">

            {{-- Tipo de documento --}}
            <div class="mb-3 col-4">
                <label class="form-label">Tipo de documento</label>
                <input type="text" class="form-control text-center" disabled value="{{$facturation->client->document_type->name}}"/>
            </div>

            {{-- Numero de documento --}}
            <div class="mb-3 col-4">
                <label class="form-label">Numero de documento</label>
                <input type="text" class="form-control text-center" disabled value="{{$facturation->client->document_number}}"/>
            </div>

            {{-- Fecha de nacimiento --}}
            <div class="mb-3 col-4">
                <label class="form-label">Fecha de nacimiento</label>
                <input type="text" class="form-control text-center" disabled value="{{$facturation->client->date_birth}}"/>
            </div>
        </div>

        {{-- Grupo 3 --}}
        <div class="row justify-content-center">

            {{-- Telefono --}}
            <div class="mb-3 col-4">
                <label class="form-label">Telefono</label>
                <input type="text" class="form-control text-center" disabled value="{{$facturation->client->phone_number}}"/>
            </div>

            {{-- Correo electronico --}}
            <div class="mb-3 col-4">
                <label class="form-label">Correo electronico</label>
                <input type="text" class="form-control text-center" disabled value="{{$facturation->client->email}}"/>
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

    {{-- Botones --}}
    <div class="text-center">

        {{-- Boton: Registrar entrega --}}
        <form action="{{route("admin.delivery.update", $facturation->slug)}}" method="post">

            {{-- Token de seguridad --}}
            @csrf

            {{-- Metodo de envio --}}
            @method("PUT")

            {{-- Boton: Guardar --}}
            <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Confirmar creación">
                <button type="submit" class="btn btn-success col-12">
                    Registrar Entrega
                </button>
            </div>

            {{-- Boton: Cancelar --}}
            <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Cancelar creación">
                <a class="btn btn-danger col-12" href="{{route("admin.delivery.index")}}" role="button">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

@endsection