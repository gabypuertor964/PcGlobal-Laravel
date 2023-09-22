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
        Schema::create('deliveries', function (Blueprint $table) {
            
            //Llave primaria
            $table->integerIncrements('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->unsignedInteger('id_sale_invoice')->comment("Fk Id Factura");

                $table->bigInteger('id_worker')->comment("Fk Id Trabajador");

                $table->unsignedInteger('id_delivery_method')->comment("Fk Id tipo de entrega");

                $table->bigInteger('id_address')->comment("Fk Id Direccion")->nullable();

                $table->datetime('date_delivery')->comment("Fecha y Hora entrega")->nullable();
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llave Foranea */
                $table->foreign('id_sale_invoice')->references('id')->on("sales_invoices");

                $table->foreign('id_worker')->references('id')->on('users');

                $table->foreign('id_delivery_method')->references('id')->on('delivery_methods');

                $table->foreign('id_address')->references('id')->on('addresses');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
