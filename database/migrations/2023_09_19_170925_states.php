<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla: Estados de los procesos x area/departamento
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {

            //Llave primaria
            $table->unsignedInteger('id',true)->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->string("name",50)->unique()->comment("Nombre del Estado");
                $table->unsignedInteger('area_id')->comment("Id Area");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves foraneas */
                $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade')->onUpdate('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
