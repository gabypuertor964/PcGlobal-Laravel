{{-- Validar si se deben añadir clases de tailwind adicionales --}}
@php
    if(request()->is('login') || request()->is('registerView')){
        $add_class = "w-1/3 mx-auto absolute bottom-5 left-1/2 transform -translate-x-1/2";
    }else{
        $add_class = "";
    }
@endphp

{{-- 
    Visualizar mensajes de alerta (Session o Error) recibidos desde el controlador
--}}
@if (session('message'))
    <div class="alert alert-{{session('message.status')}} text-center {{$add_class}}" role="alert">
        <strong>{{ session('message.text') }}</strong>
    </div>
@else
    @if ($errors->any())
        <div class="alert alert-warning text-center {{$add_class}}" role="alert">
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
@endif