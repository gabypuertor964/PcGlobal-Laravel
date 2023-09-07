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
                $table->unsignedInteger('id_cliente')->comment("Id Cliente");

                $table->unsignedInteger("id_trabajador")->comment("Id Trabajador");

                $table->unsignedInteger("id_tipo_pqrs")->comment("Id tipo PQRS");

                $table->unsignedInteger("id_estado")->comment("Id estado PQRS");

                $table->string("descripcion",255)->unique()->comment("Descripcion de la PQRS");

                $table->string("respuesta",255)->comment("Respuesta del Trabajador a la PQRS");
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
