{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Editar Producto')

{{-- Titulo principal --}}
@section('content_header')
    <h1 class="text-center font-weight-bold font-italic">Editar Empleado</h1>
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

    {{-- Visualizacion de errores --}}
    @include('components.alert')

    {{-- Formulario --}}
    <form action="{{route("admin.workers.update",$worker->slug_encrypt)}}" method="post" enctype="multipart/form-data">

        {{-- Token de seguridad --}}
        @csrf

        {{-- Metodo --}}
        @method('PUT')

        {{-- Inputs --}}
        <div class="flex flex-col gap-3 w-full md:w-1/3 mx-auto mb-3">
            <div class="edit-form min-w-full row-span-2">

                {{-- Input: Nombres --}}
                <div class="mb-3">
                    <label for="names" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="names" id="names" value="{{old('names', $worker->names)}}" min="1" max="255" required/>
                </div>

                {{-- Input: Apellidos --}}
                <div class="mb-3">
                    <label for="surnames" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="surnames" id="surnames" value="{{old('surnames', $worker->surnames)}}" min="1" max="255" required/>
                </div>

                {{-- Select: Género --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Género</label>
                    <select class="form-select form-select" name="category_id">
                        <option disabled selected class="fw-bold">Seleccione</option>
                        
                        @foreach ($genders as $gender)
                            @if (old('gender_id', $worker->gender_id) == $gender->id)
                                <div class="option-custom">
                                    <option value="{{$gender->id}}" selected>{{$gender->name}}</option>
                                </div>    
                            @else
                                <option value="{{$gender->id}}">{{$gender->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Select: Tipo de Documento --}}
                <div class="mb-3">
                    <label for="brand_id" class="form-label">Tipo de Documento</label>
                    <select class="form-select form-select" name="brand_id">
                        <option disabled selected class="fw-bold">Seleccione</option>
                        
                        @foreach ($document_types as $document_type)
                            @if (old('document_type_id', $worker->document_type_id) == $document_type->id)
                                <option value="{{$document_type->id}}" selected>{{$document_type->name. " - ". $document_type->abbreviation}}</option>
                            @else
                                <option value="{{$document_type->id}}">{{$document_type->name. " - ". $document_type->abbreviation}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                {{-- Input:  Número de telefono --}}
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Número de Telefono</label>
                    <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{old('phone_number', $worker->phone_number)}}" required/>
                </div>

                {{-- Input:  Correo electrónico --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email', $worker->email)}}" required/>
                </div>
                
                {{-- Select: Rol --}}
                <div class="mb-3">
                    <label for="role_id" class="form-label">Rol</label>
                    <select class="form-select form-select" name="role_id">
                        <option disabled selected class="fw-bold">Seleccione</option>
                        
                        @foreach ($roles as $role)
                            @if (old('role_id', $worker->roles->first()->id) == $role->id)
                                <option value="{{$role->id}}" selected>{{ucfirst(str_replace('_', ' ', $role->name))}}</option>
                            @else
                                <option value="{{$role->id}}">{{ucfirst(str_replace('_', ' ', $role->name))}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            
        {{-- Botones --}}
        <div class="text-center">
            {{-- Boton: Guardar --}}
            <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Confirmar creación">
                <button type="submit" class="btn btn-success col-12">
                    <i class="fa-solid fa-check"></i>
                </button>
            </div>

            {{-- Boton: Cancelar --}}
            <div class="button-tooltip w-1/3 lg:w-1/4" data-tooltip="Cancelar creación">
                <a class="btn btn-danger col-12" href="{{route("admin.workers.index")}}" role="button">
                    <i class="fa-solid fa-plus fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
                </a>
            </div>
        </div>
    </form>
    
@endsection

{{-- Importacion scripts --}}
@section('js')
    <script src="{{asset('resources/js/clone_row.js')}}"></script>
@endsection