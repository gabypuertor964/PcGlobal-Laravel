{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion complemtento etiqueta litle del Header --}}
@section('title','Login')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')

  <form action="{{route("clientRegister")}}" method="post">
    {{--Tokem de Seguridad--}}
    @csrf

    <div class="mb-3">
      <label for="nombres" class="form-label">Nombres:</label>
      <input type="text" class="form-control" name="nombres" id="nombres" required max='30'>
    </div>

    <div class="mb-3">
      <label for="apellidos" class="form-label">Apellidos:</label>
      <input type="text" class="form-control" name="apellidos" id="apellidos" required max='30'>
    </div>

    <div class="mb-3">
      <label for="id_sexo" class="form-label">Sexo</label>
      <select class="form-select" name="id_sexo" id="id_sexo" required>
        <option selected >Seleccione</option>  
        @foreach ($sexos as $sexo)
          <option value="{{$sexo->id}}">{{$sexo->nombre}}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="id_tip_doc" class="form-label">Tipo Documento</label>
      <select class="form-select" name="id_tip_doc" id="id_tip_doc" required>
        <option selected >Seleccione</option>  
        @foreach ($tipos_documento as $tipo_documento)
          <option value="{{$tipo_documento->id}}">{{$tipo_documento->siglas}} - {{$tipo_documento->nombre}}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="num_doc" class="form-label">Numero de Documento:</label>
      <input type="number" class="form-control" name="num_doc" id="num_doc" required>
    </div>

    <div class="mb-3">
      <label for="num_tel" class="form-label">Numero Telefonico:</label>
      <input type="number" class="form-control" name="num_tel" id="num_tel" required>
    </div>

    <div class="mb-3">
      <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
      <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Correo Electronico:</label>
      <input type="email" class="form-control" name="email" id="email" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Registrarse</button>

    <a href="{{route('login')}}">¿Ya tienes cuenta?, Inicia Sesion</a>
  </form>

@endsection