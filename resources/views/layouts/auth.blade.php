{{-- Extender desde la plantilla principal --}}
@extends('layouts.landing')

{{-- Sobreescritura/Eliminacion del la declaracion del navbar del layout de donde se extiende --}}
@section('navbar')
@endsection

{{-- Titulo header segun la ruta actual --}}
@if (request()->routeIs('login'))
    @section('title','Inicia sesión')
@else
    @section('title','Registrate')
@endif

{{-- Declaracion clases css adicionales al contenedor body --}}
@section('body_class','flex flex-col min-h-screen bg-gray-100 overflow-x-hidden')

{{-- Declaracion clases css adicionales al contenedor main --}}
@section('main_class','container my-8 text-justify mx-auto flex-grow')

{{-- Estructura basica de los formularios --}}
@section('content')

    <div class="login-header"></div>
    <div class="login-card">
        <a href="{{ route('index') }}" rel="preload" aria-label="Link for index" class="login-header-logo">
            <img src="{{ asset('storage/others/logotype.png') }}" alt="logo">
        </a>
        <form action="{{request()->routeIs('login') ? route('login') : route('register')}}" method="post" class="login-form">

            {{-- Token CSRF--}}
            @csrf

            <div class="input-container">

                {{-- Campos del formulario --}}
                @yield('inputs')

            </div>

            {{-- Botones segun ruta actual --}}
            @if (request()->routeIs('login'))
                <input type="submit" class="login-submit" value="Inicia sesión">

                <div class="login-remember">
                    <input type="checkbox" name="Recuérdame" id="rememberme">
                    <label for="rememberme" class="remember-label">Recuérdame</label>
                </div>
            @else
                <input type="submit" class="login-submit" value="Registrate">
            @endif

            {{-- Enlaces segun ruta actual --}}
            <div class="login-action-links">
                @if (request()->routeIs('login'))
                    <a href="{{route('password.request')}}" aria-label="Change your password">¿Olvidaste tu contraseña?</a>
                    <a href="{{route('register')}}" aria-label="Create an account">¿No tienes cuenta? Regístrate.</a>
                @else
                    <a href="{{ route('login') }}" aria-label="Login">¿Ya tienes cuenta? Inicia sesión.</a>
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
@endsection

{{-- Sobreescritura/Eliminacion del la declaracion del footer del layout de donde se extiende --}}
@section('footer')
@endsection