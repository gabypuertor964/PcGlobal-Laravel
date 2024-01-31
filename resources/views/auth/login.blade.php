{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion de los campos del formulario --}}
@section('inputs')
    <div class="login-email-container">
        <input type="text" class="login-input" name="email">
        <span class="email-label">Correo</span>
    </div>
    <div class="login-password-container">
        <input type="password" class="login-input" name="password">
        <span class="password-label">Contraseña</span>
    </div>
@endsection