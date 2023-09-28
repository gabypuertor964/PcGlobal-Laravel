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
        Schema::create('categories', function (Blueprint $table) {

            //Llave primaria
            $table->integerIncrements('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->string("name",50)->unique()->comment("Nombre Categoría");

                $table->string("slug")->unique()->comment("Ruta Url");
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
        Schema::dropIfExists('categories');
    }
};
