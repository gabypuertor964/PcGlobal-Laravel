{{-- Extender desde la platnilla principal --}}
@extends('layouts.main')

{{-- Declaracion de dependencias --}}
@section('dependences')
    @vite([
        //Tailwind
        'resources/css/tailwind.css',

        //Estilos personalizados
        'public/resources/css/app.css'
    ])
@endsection

{{-- Importacion componente navbar --}}
@section('navbar')
    @include('components.navbars.landing')
@endsection