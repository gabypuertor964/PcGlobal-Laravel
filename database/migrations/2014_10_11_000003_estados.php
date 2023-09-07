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
        Schema::create('estados', function (Blueprint $table) {
            /* 
                Nombre campo: id
                Tipo: Llave Primaria
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalziados */
                $table->string("nombre",20)->unique()->comment("Nombre Estado");

                $table->unsignedInteger("id_area")->comment("Id Area");
            //

            /* Llaves Foraneas */
                $table->foreign("id_area")->references('id')->on('areas');
            //

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
