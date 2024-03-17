{{-- Extender desde la platnilla principal --}}
@extends('layouts.main')

{{-- Declaracion de dependencias adicionales --}}
@section('dependences')
    @vite([
        //Bootstrap
        'resources/css/bootstrap.scss',
        'resources/js/bootstrap.js',

        //Font Awesome
        'resources/js/font-awesome.js',
    ])
@endsection

{{-- Importacion componente navbar --}}
@section('navbar')
    @include('components.navbars.landing')
@endsection

{{-- Importacion componente footer --}}
@section('footer')
    @include('components.footer')
@endsection

{{-- Importacion de scripts --}}
@section('scripts')
    @routes
    @vite([
        'resources/js/navbar.js',
        'resources/js/scroll.js',
        'resources/js/search.js',
        'resources/js/fade-alert.js',
    ])
@endsection