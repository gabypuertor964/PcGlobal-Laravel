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
        Schema::create('facturas_compra', function (Blueprint $table) {
            /* 
                Nombre campo: id
                Tipo: Llave Primaria
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */

                //Fecha y hora en la que se realizo la compra
                $table->datetime("fecha_compra")->unique()->comment("Fecha y Hora ejecucion compra");

                //Foreign Key: Trabajador que solicito la compra
                $table->unsignedInteger("id_trabajador_solicitante")->comment("Fk Id Trabajador que realizo la compra");

                //Fecha y hora en la que se recibio el pedido
                $table->datetime("fecha_recibido")->unique()->comment("Fecha y Hora recepcion del pedido");

                //Foreign Key: Trabajador que recibio el pedido
                $table->unsignedInteger("id_trabajador_receptor")->comment("Fk Id Trabajador que realiza el pedido");

                //Subtotal de la factura
                $table->string("subtotal",10)->comment("Subtotal Factura");

                //Impuestos de la factura
                $table->string("impuestos",10)->comment("Valor Impuestos");

                //Total de la factura
                $table->string("total",10)->comment("Valor Total Compra");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign("id_trabajador_solicitante")->references("id")->on("users");

                $table->foreign("id_trabajador_receptor")->references("id")->on("users");
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_compra');
    }
};
