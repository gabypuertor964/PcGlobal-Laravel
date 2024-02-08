<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla: Registros de PQRS (Peticiones, Quejas, Reclamos, Sugerencias)
     */
    public function up(): void
    {
        Schema::create('pqrs', function (Blueprint $table) {

            //Llave primaria
            $table->unsignedInteger('id',true)->comment("Llave Primaria");

            /* Campos Personalizados  */
                $table->bigInteger("client_id")->comment("Id Cliente");

                $table->unsignedInteger("pqrs_type_id")->comment("Id Tipo de PQRS");

                $table->string("title",50)->comment("Titulo de la PQRS");

                $table->string("description",500)->comment("Descripcion de la PQRS");

                $table->date("date_ocurrence")->comment("Fecha de Ocurrencia");

                $table->string("file",100)->nullable()->comment("Archivo de la PQRS");

                $table->bigInteger('worker_id')->nullable()->comment("Id Trabajador");

                $table->string("response",500)->nullable()->comment("Respuesta de la PQRS");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign("client_id")->references("id")->on("users");

                $table->foreign("pqrs_type_id")->references("id")->on("pqrs_types");

                $table->foreign("worker_id")->references("id")->on("users");
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
