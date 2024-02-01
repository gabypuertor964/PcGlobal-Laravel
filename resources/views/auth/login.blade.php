{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion de los campos del formulario --}}
@section('inputs')
    <div class="login-container email">
        <input required id="email" type="text" class="login-input" name="email" placeholder="">
        <label for="email" class="input-label">Correo</label>
    </div>
    <div class="login-container password">
        <input required id="password" type="password" class="login-input" name="password" placeholder="">
        <label for="password" class="input-label">Contraseña</label>
    </div>
@endsection