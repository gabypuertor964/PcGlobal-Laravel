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
            /* 
                Nombre campo: id
                Tipo: Llave Primaria

                Caracteristicas:
                    1.unsignedInteger -> Valores enteros de -2^31 a 2^31-1

                    2.Unsigned -> No acepta valores Negativos

                    3.auto_increment -> Valores Auto Incrementales
                //
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->string('nombres',30)->comment("Nombres");

                $table->string('apellidos',30)->comment("Apellidos");

                $table->unsignedInteger('id_sexo')->comment("Id Sexo");

                $table->unsignedInteger("id_tip_doc")->comment("Id tipo documento");

                $table->string("num_doc",15)->unique()->comment("Numero de Documento");

                $table->string("num_tel",10)->unique()->comment("Numero Telefonico");

                $table->date("fecha_nacimiento")->comment("Fecha de Nacimiento");

                $table->string('email',255)->unique()->comment("Correo Electronico");

                $table->string('password',255)->unique()->comment("Contraseña Hasheada");

                $table->timestamp('email_verified_at')->nullable()->comment("Fecha y Hora validacion de correo electronico");

                $table->rememberToken()->comment("Token 'recuerdame'");

                $table->unsignedInteger("id_estado")->comment("Id estado cuenta");
            //

            //Campos Create_at y Update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign('id_sexo')->references('id')->on("sexos");

                $table->foreign('id_tip_doc')->references('id')->on("tipos_documento");

                $table->foreign('id_estado')->references('id')->on('estados');
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
