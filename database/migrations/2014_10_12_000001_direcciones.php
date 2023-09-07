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
        Schema::create('direcciones', function (Blueprint $table) {
            /* 
                Nombre campo: id
                Tipo: Llave Primaria
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */

                //Foreign Key: Cliente
                $table->unsignedInteger("id_cliente")->comment("Fk id Cliente");

                //Direccion de domicilio
                $table->text("direccion")->comment("Direccion cliente");
            //

            //Campos Create_at y Update_at
            $table->timestamps();

            /* Llaves Foreanos */ 
                $table->foreign('id_cliente')->references('id')->on("users");
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
