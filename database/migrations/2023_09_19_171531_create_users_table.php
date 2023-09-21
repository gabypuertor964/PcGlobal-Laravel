<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            //Llave primaria
            $table->bigInteger('id',true)->comment("Id Usuario");

            /* Campos Personalizados */
                $table->string("names",30)->comment("Nombres");

                $table->string("surnames",30)->comment("Apellidos");

                $table->unsignedInteger("gender_id")->comment("Id Sexo");

                $table->unsignedInteger("document_type_id")->comment("Id tipo documento");

                $table->string("document_number",15)->unique()->comment("Numero de Documento");

                $table->string("phone_number",10)->unique()->comment("Numero Telefonico");

                $table->date("date_birth")->comment("Fecha de Nacimiento");

                $table->string('email',255)->unique()->comment("Correo Electronico");

                $table->string('password',255)->comment("Contraseña Hasheada");

                $table->timestamp('email_verified_at')->nullable()->comment("Fecha y Hora validacion de correo electronico");

                $table->rememberToken()->comment("Token 'recuerdame'");

                $table->unsignedInteger("state_id")->comment("Id estado cuenta");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llave Foranea */
                $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade')->onUpdate('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
