{{-- 
    Visualizar mensajes de alerta (Session o Error) recibidos desde el controlador
--}}
@if (session('message'))
    <div class="alert alert-{{session('message.status')}} text-center w-1/3 mx-auto absolute bottom-5 left-1/2 transform -translate-x-1/2" role="alert">
        <strong>{{ session('message.text') }}</strong>
    </div>
@else
    @if ($errors->any())
        <div class="alert alert-warning text-center w-1/3 mx-auto absolute bottom-5 left-1/2 transform -translate-x-1/2" role="alert">
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
@endif