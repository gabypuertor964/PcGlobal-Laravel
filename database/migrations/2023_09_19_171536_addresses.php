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
        Schema::create('addresses', function (Blueprint $table) {
            
            //Llave primaria
            $table->bigInteger('id')->primary()->comment("Id Usuario");

            /* Campos Personalizados */
                $table->bigInteger("client_id")->comment("Id Cliente");

                $table->text("address")->comment("Direccion de domicilio");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign("client_id")->references("id")->on("users");
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
