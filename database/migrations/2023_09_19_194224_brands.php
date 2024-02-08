<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla: Marcas
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {

            //Llave primaria
            $table->integerIncrements('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->string("name",50)->unique()->comment("Nombre Marca");

                $table->string("slug",50)->unique()->comment("Slug Marca");
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
        Schema::dropIfExists('brands');
    }
};
