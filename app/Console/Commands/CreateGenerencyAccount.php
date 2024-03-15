<?php

namespace App\Console\Commands;

use App\Helpers\CleanInputs;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateGenerencyAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-gerency-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear la cuenta de gerencia en el sistema.';

    /**
     * Lista de reglas de validación.
    */
    private $rules = [
        'names' => 'required|string|max:255|min:1',
        'surnames' => 'required|string|max:255|min:1',
        'gender_id' => 'required|exists:genders,id',
        'document_type_id' => 'required|exists:document_types,id',
        'document_number' => 'required|int|max:9999999999|min:1',
        'phone_number' => 'required|int|max:9999999999|min:1',
        'birth_date' => "required|date",
        'email' => 'required|email|max:255|min:1|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ];

    /**
     * Lista de mensajes de error personalizados.
    */
    private $messages = [
        'names.required' => 'El campo nombres es requerido.',
        'names.string' => 'El campo nombres debe ser una cadena de caracteres.',
        'names.max' => 'El campo nombres no puede tener más de :max caracteres.',
        'names.min' => 'El campo nombres debe tener al menos :min caracteres.',

        'surnames.required' => 'El campo apellidos es requerido.',
        'surnames.string' => 'El campo apellidos debe ser una cadena de caracteres.',
        'surnames.max' => 'El campo apellidos no puede tener más de :max caracteres.',
        'surnames.min' => 'El campo apellidos debe tener al menos :min caracteres.',

        'gender_id.required' => 'El campo género es requerido.',
        'gender_id.exists' => 'El género seleccionado no es válido.',

        'document_type_id.required' => 'El campo tipo de documento es requerido.',
        'document_type_id.exists' => 'El tipo de documento seleccionado no es válido.',

        'document_number.required' => 'El campo número de documento es requerido.',
        'document_number.int' => 'El campo número de documento debe ser un número entero.',
        'document_number.max' => 'El campo número de documento no puede ser mayor que :max.',
        'document_number.min' => 'El campo número de documento no puede ser menor que :min.',

        'phone_number.required' => 'El campo número de teléfono es requerido.',
        'phone_number.int' => 'El campo número de teléfono debe ser un número entero.',
        'phone_number.max' => 'El campo número de teléfono no puede ser mayor que :max.',
        'phone_number.min' => 'El campo número de teléfono no puede ser menor que :min.',

        'birth_date.required' => 'El campo fecha de nacimiento es requerido.',
        'birth_date.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',

        'email.required' => 'El campo correo electrónico es requerido.',
        'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
        'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
        'email.min' => 'El campo correo electrónico debe tener al menos :min caracteres.',
        'email.unique' => 'El correo electrónico ingresado ya está en uso.',

        'password.required' => 'El campo contraseña es requerido.',
        'password.string' => 'El campo contraseña debe ser una cadena de caracteres.',
        'password.min' => 'El campo contraseña debe tener al menos :min caracteres.',
        'password.confirmed' => 'La confirmación de la contraseña no coincide.',
    ];
    
    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            $names = $this->ask('Nombres');
            $surnames = $this->ask('Apellidos');
        
            $genders = Gender::all()->pluck('name', 'id')->toArray();
            $gender_name = $this->choice('Género', array_values($genders));
            $gender_id = array_search($gender_name, $genders);
        
            $document_types = DocumentType::all()->pluck('name', 'id')->toArray();
            $document_type_name = $this->choice('Tipo de Documento', array_values($document_types));
            $document_type_id = array_search($document_type_name, $document_types);

            $document_number = $this->ask('Numero de documento');
            $phone_number = $this->ask('Numero de telefono');
            $date_birth = $this->ask('Ingrese la fecha (formato: YYYY-YYMM-DD)');
            $email = $this->ask('Correo electronico');
            $password = $this->secret('Contraseña');
            $password_confirmation = $this->secret('Confirmar contraseña');
        
            # Ejecutar las validaciones
            $validator = Validator::make([
                'names' => $names,
                'surnames' => $surnames,
                'gender_id' => $gender_id,
                'document_type_id' => $document_type_id,
                'document_number' => $document_number,
                'phone_number' => $phone_number,
                'birth_date' => $date_birth,
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password_confirmation,
            ], $this->rules, $this->messages);
        
            # Retornar los mensajes de error (si existen)
            if ($validator->fails()) {
                $this->output->error($validator->errors()->first());
                return;
            }

            /**
             * Transaccion para la creacion de un gerente
            */
            DB::transaction(function() use($names, $surnames, $gender_id, $document_type_id, $document_number, $phone_number, $date_birth, $email, $password){

                # Crear el usuario
                $user = User::create([
                    'names'=>CleanInputs::upper($names),
                    'surnames'=>CleanInputs::upper($surnames),
                    'gender_id'=>$gender_id,
                    'document_type_id'=>$document_type_id,
                    'document_number'=>$document_number,
                    'phone_number'=>$phone_number,
                    'date_birth'=>$date_birth,
                    'email'=>CleanInputs::lower($email),
                    'password'=>Hash::make($password),
                ]);

                # Asignar el rol de gerente
                $user->assignRole('gerente');
            });

            // Mostrar mensaje de exito
            $this->output->success('Cuenta de gerencia creada correctamente.');
        }catch(Exception){

            // Mostrar mensaje de error
            $this->output->error('Ha ocurrido un error al intentar crear la cuenta de gerencia.');
        }
    }
}
