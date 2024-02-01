{{-- Declaracion e importacion componente principal --}}
@extends('layouts.auth')

{{-- Declaracion de los campos del formulario --}}
@section('inputs')
    {{-- Input: Nombres (names) --}}
    <div>
        <div class="login-container names">
            <input required id="names" type="text" class="login-input" name="names" placeholder="">
            <label for="names" class="input-label">Nombres</label>
        </div>
    </div>

    {{-- Input: Apellidos (surnames) --}}
    <div>
        <div class="login-container surnames">
            <input required id="surnames" type="text" class="login-input" name="surnames" placeholder="">
            <label for="surnames" class="input-label">Apellidos</label>
        </div>
    </div>

    {{-- Input: Numero de documento (document_number) --}}
    <div>
        <div class="login-container document_number">
            <input required id="document_number" type="number" class="login-input" name="document_number" placeholder="">
            <label for="document_number" class="input-label">Número de documento</label>
        </div>
    </div>

    {{-- Input: Correo (email) --}}
    <div>
        <div class="login-container email">
            <input required id="email" type="text" class="login-input" name="email" placeholder="">
            <label for="email" class="input-label">Correo</label>
        </div>
    </div>

    {{-- Input: Telefono (phone_number) --}}
    <div>
        <div class="login-container phone_number">
            <input required id="phone_nombre" type="text" class="login-input" name="phone_number" placeholder="">
            <label for="phone_number" class="input-label">Teléfono</label>
        </div>
    </div>

    {{-- Input: Fecha de nacimiento (date_birth) --}}
    <div>
        <div class="login-container date_birth">
            <input required id="date_birth" type="date" class="login-input" name="date_birth" placeholder="" min="{{now()->subYears(100)->format('Y-m-d')}}" max="{{now()->subYears(18)->format('Y-m-d')}}">
            <label for="date_birth" class="input-label">Fecha de nacimiento</label>
        </div>
    </div>

    {{-- Input: Genero (gender_id) --}}
    <div>
        <div class="login-container gender_id">
            <select required id="gender_id" class="login-input" name="gender_id">
                <option selected>Selecciona una opción</option>
                @foreach ($genders as $gender)
                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                @endforeach
            </select>
            <label for="gender_id" class="input-label">Género</label>
        </div>
    </div>

    {{-- Input: Tipo de documento (document_type_id) --}}
    <div>
        <div class="login-container document_type_id">
            <select required id="document_type_id" class="login-input" name="document_type_id">
                <option selected>Selecciona una opción</option>
                @foreach ($document_types as $document)
                <option value="{{ $document->id }}">{{ $document->name }}</option>
                @endforeach
            </select>
            <label for="document_type_id" class="input-label">Tipo de documento</label>
        </div>
    </div>

    {{-- Input: Contraseña (password) --}}
    <div>
        <div class="login-container password">
            <input required id="password" type="password" class="login-input" name="password" placeholder="">
            <label for="password" class="input-label">Contraseña</label>
        </div>
    </div>

    {{-- Input: Confirmar contraseña (password_confirmation) --}}
    <div>
        <div class="login-container password_confirmation">
            <input required id="password_confirmation" type="password" class="login-input" name="password_confirmation" placeholder="">
            <label for="password_confirmation" class="input-label overflow-hidden whitespace-nowrap text-ellipsis">Confirma la contraseña</label>
        </div>
    </div>
@endsection