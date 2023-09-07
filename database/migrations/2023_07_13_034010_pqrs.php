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
        Schema::create('pqrs', function (Blueprint $table) {
            /* 
                Nombre campo: id
                Tipo: Llave Primaria
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */

                //Foreign Key: Cliente que realiza la PQRS
                $table->unsignedInteger('id_cliente')->comment("Id Cliente");
        
                //Titulo o Asunto de la PQRS
                $table->string('titulo', 70)->comment("Titulo PQRS");

                //Url de la Imagen de evidencia de la PQRS (Opcional)
                $table->text('url_evidencia')->comment("Imagen de evidencia de la PQRS")->nullable();

                //Descripcion de la PQRS
                $table->string("descripcion",255)->unique()->comment("Descripcion de la PQRS");

                //Foreign Key: Trabajador que responde la PQRS
                $table->unsignedInteger("id_trabajador")->comment("Id Trabajador");

                //Respuesta del Trabajador a la PQRS
                $table->string("respuesta",255)->comment("Respuesta del Trabajador a la PQRS");

                //Foreign Key: Tipo de PQRS
                $table->unsignedInteger("id_tipo_pqrs")->comment("Id tipo PQRS");

                //Foreign Key: Estado de la PQRS
                $table->unsignedInteger("id_estado")->comment("Id estado PQRS");
            //

            //Campos Create_at y Update_at
            $table->timestamps();

            /* Llaves Foraneas*/
                $table->foreign("id_cliente")->references("id")->on("users");

                $table->foreign("id_trabajador")->references("id")->on("users");

                $table->foreign("id_estado")->references("id")->on("estados");

                $table->foreign("id_tipo_pqrs")->references("id")->on("tipo_pqrs");
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqrs');
    }
};
