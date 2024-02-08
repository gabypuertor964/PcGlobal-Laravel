<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla: Generos/Sexos
     */
    public function up(): void
    {
        Schema::create('genders', function (Blueprint $table) {

            //Llave primaria
            $table->unsignedInteger('id',true)->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->string("name",10)->unique()->comment("Nombre del Sexo");
            //

            //Campos create_at y update_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genders');
    }
};
