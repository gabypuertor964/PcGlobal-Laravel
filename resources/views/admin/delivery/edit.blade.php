{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Registrar Entrega')

{{-- Titulo principal --}}
@section('content_header')
    <div class="w-fit mx-auto">
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

    {{-- Card de la factura --}}
    <div class="bg-white shadow-md invoice-card">
        {{-- Título: Información básica --}}
        <p class="text-lg text-center border-b w-fit mx-auto mt-3">Información básica</p>

        {{-- Apartado: Información básica --}}
        <div class="invoice-card-content basics">
            <ul class="list-disc">
                {{-- Fecha --}}
                <li>
                    <span class="font-semibold">Fecha: </span> 
                    {{$facturation->datetime["date"]}}
                </li>

                {{-- Hora --}}
                <li>
                    <span class="font-semibold">Fecha: </span> 
                    {{$facturation->datetime["time"]}}
                </li>
            </ul>
        </div>

        {{-- Título: Información básica --}}
        <p class="text-lg text-center border-b w-fit mx-auto mt-3">Información del Cliente</p>

        {{-- Apartado: Información del cliente --}}
        <div class="invoice-card-content basics grid grid-cols-1 lg:grid-cols-3 text-center">
            {{-- Nombres --}}
            <p class="flex flex-col">
                <span class="font-semibold">Nombre</span> 
                {{$facturation->client->names}}
            </p>

            {{-- Apellidos --}}
            <p class="flex flex-col">
                <span class="font-semibold">Apellidos</span> 
                {{$facturation->client->surnames}}
            </p>
            
            {{-- Género/Sexo --}}
            <p class="flex flex-col">
                <span class="font-semibold">Género/Sexo</span> 
                {{$facturation->client->gender->name}}
            </p>

            {{-- Tipo de documento --}}
            <p class="flex flex-col">
                <span class="font-semibold">Tipo de Documento</span> 
                {{$facturation->client->document_type->name}} - {{ $facturation->client->document_type->abbreviation }}
            </p>            

            {{-- Número de documento --}}
            <p class="flex flex-col">
                <span class="font-semibold">Número de documento</span> 
                {{$facturation->client->document_number}}
            </p>

            {{-- Fecha de nacimiento --}}
            <p class="flex flex-col">
                <span class="font-semibold">Fecha de Nacimiento</span> 
                {{$facturation->client->date_birth}}
            </p>

            {{-- Teléfono --}}
            <p class="flex flex-col">
                <span class="font-semibold">Teléfono</span> 
                {{$facturation->client->phone_number}}
            </p>

            {{-- Correo Electrónico --}}
            <p class="flex flex-col">
                <span class="font-semibold">Fecha de Nacimiento</span> 
                {{$facturation->client->email}}
            </p>
            
        </div>        

        {{-- Título: Detalles --}}
        <p class="text-lg text-center border-b w-fit mx-auto mt-3">Detalles</p>

        {{-- Apartado: Detalles --}}
        <div class="invoice-card-content details grid grid-cols-1 lg:grid-cols-2">
            {{-- Subapartado: Productos --}}
            <ul class="border-r-0 lg:border-r my-2">
                {{-- Título: Productos --}}
                <p class="font-semibold text-center border-b-2 w-full md:w-fit mx-auto">Productos</p>
                @foreach ($facturation->details as $detail)
                <div class="border-s-4 border-slate-600/25 my-3 py-1 px-3">
                    {{-- Marca --}}
                    <li>
                        <span class="font-semibold">Marca: </span> 
                        {{$detail->product->brand->name}}
                    </li>
                    
                    {{-- Nombre/Modelo --}}
                    <li>
                        <span class="font-semibold">Nombre/Modelo: </span> 
                        {{$detail->product->name}}
                    </li>
                    
                    {{-- Cantidad --}}
                    <li>
                        <span class="font-semibold">Cantidad: </span> 
                        {{$detail->quantity}}
                    </li>
                    
                    {{-- Precio Unitario --}}
                    <li>
                        <span class="font-semibold">Precio Unitario: </span> 
                        ${{number_format($detail->unit_price, 0, ',', '.')}}
                    </li>
                    
                    {{-- Precio neto --}}
                    <li>
                        <span class="font-semibold">Precio Neto: </span> 
                        ${{number_format(($detail->unit_price * $detail->quantity), 0, ',', '.')}}
                    </li>
                </div>
                @endforeach
            </ul>
            
            {{-- Subapartado: Precios --}}
            <ul class="border-l-0 lg:border-l my-2">
                {{-- Título: Productos --}}
                <p class="font-semibold text-center border-b-2 w-full md:w-fit mx-auto">Precios</p>
                <div class="border-s-4 border-slate-600/25 my-3 py-1 px-3">
                    {{-- Subtotal --}}
                    <li>
                        <span class="font-semibold">Subtotal: </span> 
                        ${{number_format($facturation->subtotal, 0, ',', '.')}}
                    </li>

                    {{-- Impuestos --}}
                    <li>
                        <span class="font-semibold">Impuestos ({{$facturation->tax_percentage}}%): </span> 
                        ${{number_format($facturation->taxes, 0, ',', '.')}}
                    </li>

                    {{-- Total --}}
                    <li>
                        <span class="font-semibold">Total: </span>
                        ${{number_format($facturation->total, 0, ',', '.')}}
                    </li>
                </div>
            </ul>
        </div>

        {{-- Boton: Volver --}}
        <div class="text-center mt-3">
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
    </div>

@endsection