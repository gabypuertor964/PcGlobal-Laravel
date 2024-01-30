@extends('adminlte::auth.register')

@section('adminlte_css_pre')
    @vite(['resources/css/bootstrap.scss','resources/js/bootstrap.js',])
@stop

@section('auth_body')
    <form action="" method="post">
        @csrf

        <div class="row">
            <div class="col">
                {{-- Name field --}}
                <div class="input-group mb-3">
                    <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror"
                           value="{{ old('nombres') }}" placeholder="Nombres" autofocus>
        
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
        
                    @error('nombres')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Lastname field --}}
                <div class="input-group mb-3">
                    <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror"
                           value="{{ old('apellidos') }}" placeholder="Apellidos">
        
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
        
                    @error('apellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Gender field --}}
                <div class="input-group mb-3">
                    <select name="id_sexo" class="form-select @error('apellidos') is-invalid @enderror"
                            value="{{ old('id_sexo') }}">
                        <option selected>Selecciona tu género</option>
                        @foreach ($sexes as $sex)
                            <option value="{{$sex->id}}">{{$sex->name}}</option>
                        @endforeach
                    </select>
        
                    @error('id_sexo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                {{-- Document field --}}
                <div class="input-group mb-3">
                    <select name="id_tip_doc" class="form-select @error('id_tip_doc') is-invalid @enderror"
                            value="{{ old('id_tip_doc') }}">
                        <option selected>Selecciona tu tipo de documento</option>
                        @foreach ($document_types as $document_type)
                            <option value="{{$document_type->id}}">{{$document_type->name}}</option>
                        @endforeach
                    </select>
        
                    @error('id_tipo_doc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Document number field --}}
                <div class="input-group mb-3">
                    <input type="number" name="num_doc" class="form-control @error('num_doc') is-invalid @enderror"
                           value="{{ old('num_doc') }}" placeholder="Número de documento">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-id-card  {{ config('adminlte.classes_auth_icon', '') }}"></span>
                        </div>
                    </div>
        
                    @error('num_doc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               </div>

               <div class="col">
                   {{-- Number phone field --}}
                   <div class="input-group mb-3">
                       <input type="number" name="num_tel" class="form-control @error('num_tel') is-invalid @enderror"
                           value="{{ old('num_tel') }}" placeholder="Número de teléfono">
                           
                        <div class="input-group-append">
                            <div class="input-group-text">
                                 <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>
        
                    @error('num_tel')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- Birth date field --}}
            <div class="input-group mb-3">
            <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
            value="{{ old('fecha_nacimiento') }}">


            @error('fecha_nacimiento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}" placeholder="Email">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        </div>
    </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop