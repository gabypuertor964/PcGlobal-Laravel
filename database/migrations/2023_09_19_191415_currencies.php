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
        Schema::create('currencies', function (Blueprint $table) {
            
            //Llave primaria
            $table->integerIncrements('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->string('name', 20)->comment("Nombre Moneda");

                $table->string('symbol', 5)->comment("Simbolo Moneda");
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
        Schema::dropIfExists('currencies');
    }
};
