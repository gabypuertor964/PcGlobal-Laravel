{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion complemtento etiqueta litle del Header --}}
@section('title','Inicia sesión para continuar')

{{-- Declaracion clases css adicionales al contenedor body --}}
@section('body_class','flex flex-col min-h-screen bg-gray-100 overflow-x-hidden')

{{-- Declaracion clases css adicionales al contenedor main --}}
@section('main_class','container my-8 text-justify mx-auto flex-grow')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')
    <div class="login-header">
    </div>
    <div class="login-card">
        <a href="{{ route('index') }}" rel="preload" aria-label="Link for index" class="login-header-logo">
            <img src="{{ asset('storage/others/logotype.webp') }}" alt="logo">
        </a>
        <form action="" method="post" class="login-form">
            @csrf
            <div class="login-email-container">
                <input type="text" class="login-input" placeholder="">
                <span class="email-label">Correo</span>
            </div>
            <div class="login-password-container">
                <input type="text" class="login-input" placeholder="">
                <span class="password-label">Contraseña</span>
            </div>
            <input type="submit" class="login-submit" value="Inicia sesión">
            <div class="login-remember">
                <input type="checkbox" name="Recuérdame" id="rememberme">
                <label for="rememberme" class="remember-label">Recuérdame</label>
            </div>
            <div class="login-action-links">
                <a href="#" aria-label="Change your password">¿No recuerdas tu contraseña?</a>
                <a href="#" aria-label="Create an account">Crea una cuenta</a>
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