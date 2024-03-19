{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Editar PQRS')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Editar PQRS</h1>
@stop

{{-- Declaración de dependencias adicionales --}}
@section('adminlte_css_pre')
    @vite([
        'resources/css/tailwind.css',
        'resources/js/font-awesome.js',
        'resources/css/admin.css',
        'resources/css/bootstrap.scss',
    ])  
@endsection

{{-- Contenido principal --}}
@section('content')

    {{-- Visualizacion de mensajes --}}
    @include('components.alert')
    <div class="edit-form min-w-full justify-center">
        {{-- Formulario --}}
        <form action="{{ route("clients.pqrs.update", $pqrs->slug) }}" method="post" class="grid grid-cols-1 lg:grid-cols-2 gap-3">
            {{-- Token de seguridad --}}
            @csrf

            {{-- Método --}}
            @method("PUT")

            <section>
                {{-- Input: Título --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{old('title', $pqrs->title)}}" min="1" max="50" required/>
                </div>
                
                
                {{-- Input: Tipo PQRS --}}
                <div class="mb-3">
                    <label for="brand_id" class="form-label">Tipo</label>
                    <select class="form-select form-control" name="pqrs_type_id">
                        <option selected class="fw-bold">Seleccione</option>
                    
                        @foreach ($pqrs_types as $pqrs_type)
                            @if (old('pqrs_type_id', $pqrs->pqrs_type_id) == $pqrs_type->id)
                                <option value="{{$pqrs_type->id}}" selected>{{$pqrs_type->name}}</option>
                            @else
                                <option value="{{$pqrs_type->id}}">{{$pqrs_type->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            
                {{-- Input: Fecha de ocurrencia --}}
                <div class="mb-3">
                    <label for="date_ocurrence" class="form-label">Fecha de Ocurrencia (opcional)</label>
                    <input type="date" class="form-control" name="date_ocurrence" id="date_ocurrence" value="{{old('date_ocurrence', $pqrs->date_ocurrence)}}" min="{{ now()->subDays(30)->format('Y-m-d') }}" max="{{now()->format('Y-m-d')}}"/>
                </div>                
            </section>
            
            <div class="mb-3">
                <label for="description">Descripción</label>
                <textarea placeholder="A continuación describe el caso..." class="form-control h-full" name="description" rows="8" maxlength="500" minlength="1"></textarea>
            </div>

                {{-- Botones --}}
            <div class="text-center col-span-1 lg:col-span-2">
                {{-- Boton: Guardar --}}
                <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Confirmar creación">
                    <button type="submit" class="btn btn-success col-12">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </div>

                {{-- Boton: Cancelar --}}
                <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Cancelar creación">
                    <a class="btn btn-danger col-12" href="{{route("clients.pqrs.index")}}" role="button">
                        <i class="fa-solid fa-plus fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection