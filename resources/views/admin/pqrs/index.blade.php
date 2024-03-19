{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Lista de Productos')

{{-- Titulo principal --}}
@section('content_header')
    <div class="flex flex-col md:flex-row gap-y-2 justify-content-between align-items-center text-center">
        <h1 class="font-weight-bold font-italic">Lista de Productos</h1>

        @can('inventory.create')
            <a class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded w-full md:w-auto" href="{{route("inventory.products.create")}}" role="button">
                <i class="fa-solid fa-plus"></i>
                Crear
            </a>    
        @endcan
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

    

@endsection