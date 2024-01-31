{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion de los campos del formulario --}}
@section('inputs')
    <div class="login-email-container">
        <input type="text" class="login-input" name="email" placeholder="">
        <span class="input-label">Correo</span>
    </div>
    <div class="login-password-container">
        <input type="password" class="login-input" name="password" placeholder="">
        <span class="input-label">Contraseña</span>
    </div>
@endsection