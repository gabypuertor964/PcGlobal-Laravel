{{-- Extender del layout principal --}}
@extends('adminlte::page')

{{-- Complemento titulo --}}
@section('title', 'Editar Empleado')

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
    <form action="{{route("admin.workers.update", $worker->slug)}}" method="post">

        {{-- Token de seguridad --}}
        @csrf

        {{-- Metodo de envio --}}
        @method('PUT')

        {{-- Inputs --}}
        <div class="flex flex-col gap-3 w-full md:w-1/3 mx-auto mb-3">
            <div class="edit-form min-w-full grid grid-cols-2 gap-x-2">

                {{-- Input: Nombres --}}
                <div class="mb-3">
                    <label for="names" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="names" id="names" value="{{$worker->names}}" min="1" max="255" required/>
                </div>

                {{-- Input: Apellidos --}}
                <div class="mb-3">
                    <label for="surnames" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="surnames" id="surnames" value="{{$worker->surnames}}" min="1" max="255" required/>
                </div>

                {{-- Select: Género --}}
                <div class="mb-3">
                    <label for="gender_id" class="form-label">Género</label>
                    <select class="form-select form-select" name="gender_id">
                        @foreach ($genders as $gender)
                            @if ($worker->gender_id == $gender->id)
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
                    <label for="document_type_id" class="form-label">Tipo de Documento</label>
                    <select class="form-select form-select" name="document_type_id">
                        @foreach ($document_types as $document_type)
                            @if ($worker->document_type_id == $document_type->id)
                                <option value="{{$document_type->id}}" selected>{{$document_type->name. " - ". $document_type->abbreviation}}</option>
                            @else
                                <option value="{{$document_type->id}}">{{$document_type->name. " - ". $document_type->abbreviation}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                {{-- Input:  Numero de Documento --}}
                <div class="mb-3">
                    <label for="document_number" class="form-label">Numero de Documento</label>
                    <input type="number" class="form-control" name="document_number" id="document_number" value="{{$worker->document_number}}" required/>
                </div>

                {{-- Input:  Numero Telefonico --}}
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Numero Telefonico</label>
                    <input type="number" class="form-control" name="phone_number" id="phone_number" value="{{$worker->phone_number}}" min="1" max="9999999999"required/>
                </div>

                {{-- Input: Fecha de Nacimiento --}}
                <div class="mb-3">
                    <label for="date_birth" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="date_birth" id="date_birth" value="{{$worker->date_birth}}" min="{{now()->subday()->subYears(100)->format('Y-m-d')}}" max="{{now()->subday()->subYears(18)->format('Y-m-d')}}" required/>
                </div>

                {{-- Select: Rol --}}
                <div class="mb-3">
                    <label for="role_id" class="form-label">Rol</label>
                    <select class="form-select form-select" name="role_id">
                        @foreach ($roles as $role)
                            @if ($worker->roles->first()->id == $role->id)
                                <option value="{{$role->id}}" selected>{{ucfirst(str_replace('_', ' ', $role->name))}}</option>
                            @else
                                <option value="{{$role->id}}">{{ucfirst(str_replace('_', ' ', $role->name))}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- Input:  Correo electrónico --}}
                <div class="mb-3 col-span-2">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$worker->email}}" required/>
                </div>
                
                {{-- Input:  Contraseña --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" min="8"/>
                </div>

                {{-- Input:  Confirmar Contraseña --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" min="8"/>
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