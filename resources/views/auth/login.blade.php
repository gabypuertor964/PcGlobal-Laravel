{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion complemtento etiqueta litle del Header --}}
@section('title','Login')

{{-- Declaracion contenido principal de la pagina web --}}
@section('content')

  {{-- Declaracion y envio de clases personalidas a la etiqueta body presente en el componente principal--}}
  @section('body_class','')

  {{-- Envio de clases personalizadas a la etiqueta main, la cual se encuentra en el componente principal--}}
  @section('main_class','')

@endsection