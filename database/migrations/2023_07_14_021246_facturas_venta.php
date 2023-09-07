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
        Schema::create('facturas_venta', function (Blueprint $table) {
            /* 
                Nombre campo: id
                Tipo: Llave Primaria
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */

                //Fecha y Hora ejecucion venta
                $table->datetime("fecha_venta")->unique()->comment("Fecha y Hora ejecucion venta");

                //Foreign Key: Cliente que realiza la compra
                $table->unsignedInteger('id_cliente')->comment("Id Cliente");

                //Subtotal Factura
                $table->string("subtotal",10)->comment("Subtotal Factura");

                //IVA Factura
                $table->string("iva",10)->comment("Valor IVA");

                //Total Factura
                $table->string("total",10)->comment("Valor Total");
            //

            //Campos Create_at y Update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign("id_cliente")->references('id')->on("users");
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_venta');
    }
};
