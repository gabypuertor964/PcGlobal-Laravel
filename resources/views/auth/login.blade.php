{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion complemtento etiqueta litle del Header --}}
@section('title','Login')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')


  {{-- Declaracion y envio de clases personalidas a la etiqueta body presente en el componente principal--}}
  @section('body_class','flex flex-col min-h-screen bg-gray-100')

  {{-- Envio de clases personalizadas a la etiqueta main, la cual se encuentra en el componente principal--}}
  @section('main_class','container my-10 text-justify mx-auto flex-grow  mx-2')

  <form action="{{route("login")}}" method="post">
    {{--Tóken de Seguridad--}}
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label">Correo Electronico:</label>
      <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Iniciar Sesion</button>

    <a href="{{route('registerView')}}">¿No tienes cuenta?, Registrate</a>
  </form>

@endsection
