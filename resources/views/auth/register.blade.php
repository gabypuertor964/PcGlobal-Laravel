{{-- Extender desde la plantilla principal --}}
@extends('layouts.landing')

{{-- Sobreescritura/Eliminacion del la declaracion del navbar del layout de donde se extiende --}}
@section('navbar','')

{{-- Titulo header segun la ruta actual --}}
@section('title','Registro')

{{-- Declaracion contenido principal --}}
@section('content')
    Jose
@endsection

{{-- Sobreescritura/Eliminacion del la declaracion del footer del layout de donde se extiende --}}
@section('footer','')