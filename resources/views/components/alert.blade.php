{{-- 
    Visualizar mensajes de alerta recibidos desde el controlador
--}}
@if (session('message'))
    <div class="alert alert-{{ session('message.status') }} text-center" role="alert">
        <strong>{{ session('message.text') }}</strong>
    </div>
@endif