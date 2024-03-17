{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Mis Compras')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">¿Que compras he realizado?</h1>
    </div>
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

    {{-- Visualizacion de mensajes --}}
    @include('components.alert')

    <div class="text-center">

        {{-- Tabla de datos --}}
        <table class="table table-striped table-bordered">
        
            {{-- Cabecera de la tabla --}}
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th class="hidden lg:table-cell">Hora</th>
                    <th>Valor Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            {{-- Cuerpo de la tabla --}}
            <tbody>
                @forelse ($facturations as $facturation)
                    <tr>
                        <td class="align-middle">{{$facturation->date}}</td>
                        <td class="align-middle hidden lg:table-cell">{{$facturation->time}} (UTC-5)</td>
                        <td class="align-middle">${{number_format($facturation->total, 0, ',', '.')}}</td>
                        <td class="align-middle">{{$facturation->state->name}}</td>
                        <td>
                            <div class="flex justify-center gap-2 w-full">
                                <div class="button-tooltip" data-tooltip="Ver detalles de la factura">
                                    <a class="btn btn-primary" href="{{route('clients.facturation.show', $facturation->slug)}}" role="button">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">

                            <div class="d-block mb-2">
                                Aún no has realizado ninguna compra.
                            </div>
                            
                            {{-- Boton ir a categorias --}}
                            <a class="btn btn-primary col-5" href="{{route('index',"#categories")}}" role="button">
                                <i class="fa-solid fa-shopping-bag"></i>
                                Ver catálogo
                            </a>
                            
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{-- FIXME: Revisar posiciones --}}
        {{-- Paginacion --}}
        <div class="hidden sm:flex sm:justify-center">{{ $facturations->links('pagination::tailwind') }}</div>
    </div>
@endsection