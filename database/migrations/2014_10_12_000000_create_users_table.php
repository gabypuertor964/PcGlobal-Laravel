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
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */

                //Nombres completos
                $table->string('nombres',30)->comment("Nombres");

                //Apellidos completos
                $table->string('apellidos',30)->comment("Apellidos");

                //Foreign Key: Sexos
                $table->unsignedInteger('id_sexo')->comment("Id Sexo");

                //Foreign Key: Tipos Documento
                $table->unsignedInteger("id_tip_doc")->comment("Id tipo documento");

                //Numero de Documento
                $table->string("num_doc",15)->unique()->comment("Numero de Documento");

                //Numero Telefonico
                $table->string("num_tel",10)->unique()->comment("Numero Telefonico");

                //Fecha de Nacimiento
                $table->date("fecha_nacimiento")->comment("Fecha de Nacimiento");

                //Correo Electronico
                $table->string('email',255)->unique()->comment("Correo Electronico");

                //Hash de Contraseña
                $table->string('password',255)->unique()->comment("Contraseña Hasheada");

                //Fecha y Hora validacion de correo electronico
                $table->timestamp('email_verified_at')->nullable()->comment("Fecha y Hora validacion de correo electronico");

                //Token "recuerdame"
                $table->rememberToken()->comment("Token 'recuerdame'");

                //Foreign Key: Estados
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
