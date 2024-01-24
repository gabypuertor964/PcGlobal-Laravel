{{-- Extender desde la platnilla principal --}}
@extends('layouts.main')

{{-- Declaracion de dependencias --}}
@section('dependences')
    @vite([
        //Bootstrap
        'resources/css/bootstrap.scss',
        'resources/js/bootstrap.js',

        //Tailwind
        'resources/css/tailwind.css',

        //Font-Awesome
        'resources/js/font-awesome.js',

        //Estilos personalizados
        'public/resources/css/app.css'
    ])
@endsection

{{-- Importacion componente navbar --}}
@section('navbar')
    @include('components.navbars.landing')
@endsection