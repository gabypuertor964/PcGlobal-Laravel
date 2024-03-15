{{-- Extender desde la plantilla principal --}}
@extends('layouts.landing')

{{-- Sobreescritura/Eliminacion del la declaracion del navbar del layout de donde se extiende --}}
@section('navbar','')

{{-- Titulo header segun la ruta actual --}}
@if (request()->routeIs('login'))
    @section('title','Inicia sesión')
@else
    @section('title','Regístrate')
@endif

@section('dependences')
    @vite([
        //Hoja Personalizada
        'resources/css/app.css',

        //Tailwind CSS
        'resources/css/tailwind.css',

        //Bootstrap
        'resources/css/bootstrap.scss',
    ])
@endsection

{{-- Declaracion clases css adicionales al contenedor body --}}
@section('body_class','flex flex-col min-h-screen bg-gray-100')

{{-- Declaracion clases css adicionales al contenedor main --}}
@section('main_class','container my-8 text-justify mx-auto flex-grow')

{{-- Declaracion de dependencias adicionales --}}
@section('dependences')
    @vite([
        
        //Bootstrap
        // 'resources/css/bootstrap.scss',
        'resources/css/app.css',
        'resources/css/tailwind.css',
    ])
@endsection

{{-- Estructura basica de los formularios --}}
@section('content')

    <div class="login-header"></div>
    <div class="login-card {{ request()->routeIs('login') ? '' : 'register' }}">
        <a href="{{ route('index') }}" rel="preload" aria-label="Link for index" class="login-header-logo">
            <img src="{{ asset('storage/others/logotype.png') }}" alt="logo">
        </a>
        <h1 class="text-center mt-2 font-medium text-lg text-white">
            {{ request()->routeIs('login') ? 'Inicia sesión' : 'Crea una nueva cuenta' }}
        </h1>

        <form action="{{ request()->routeIs('login') ? route('login') : route('register') }}" method="post" class="login-form {{ request()->routeIs('login') ? 'flex' : 'grid grid-cols-2 gap-x-2'}}">

            {{-- Token CSRF--}}
            @csrf

            {{-- Campos del formulario --}}
            @yield('inputs')

            {{-- Botones segun ruta actual --}}
            @if (request()->routeIs('login'))
                <input type="submit" class="login-submit" value="Inicia sesión">

                {{-- Ocultar el botoón --}}
                {{-- <div class="login-remember invisible">
                    <span>Recuérdame</span>
                    <label class="switch">
                        <input type="checkbox" class="input">
                            <div class="rail">
                                <span class="circle"></span>
                            </div>
                        <span class="indicator"></span>
                    </label>
                </div> --}}
            @else
                <input type="submit" class="login-submit col-span-2" value="Regístrate">
            @endif

            {{-- Enlaces segun ruta actual --}}
            <div class="login-action-links col-span-2 @if (request()->routeIs('login')) mt-4 @endif">
                @if (request()->routeIs('login'))
                    <a href="{{route('register')}}" role="link" aria-label="Registrate">¿No tienes cuenta? Regístrate.</a>
                    <a href="{{route('password.request')}}" role="link" aria-label="¿Olvidaste tu contraseña?">¿Olvidaste tu contraseña?</a>
                @else
                    <a href="{{ route('login') }}" role="link" aria-label="Inicia sesión">¿Ya tienes cuenta? Inicia sesión.</a>
                @endif
            </div>
        </form>
    </div>
    <div class="login-crystals">
        <div class="login-crystal"></div>
        <div class="login-crystal"></div>
        <div class="login-crystal-2"></div>
        <div class="login-crystal-2"></div>
        <div class="login-crystal-3"></div>
        <div class="login-crystal-3"></div>
    </div>
    
    {{-- Visualizar mensajes de alerta recibidos desde el controlador --}}
    @include('components.alert')
@endsection

{{-- Sobreescritura/Eliminacion del la declaracion del footer del layout de donde se extiende --}}
@section('footer','')

{{-- Declaracion de dependencias adicionales --}}
@section('scripts')
@endsection