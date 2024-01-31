{{-- Extender desde la platnilla principal --}}
@extends('layouts.main')

{{-- Declaracion de dependencias adicionales --}}
@section('dependences')
    @vite([
        
        //Bootstrap
        'resources/css/bootstrap.scss',
        'resources/js/bootstrap.js',
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
    @vite([

    ])
@endsection