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
        Schema::create('unidades_compra', function (Blueprint $table) {
            /* 
                Nombre campo: id
                Tipo: Llave Primaria
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */

                //Foreign Key: Factura de Venta
                $table->unsignedInteger('id_factura')->comment("Fk Id factura");

                //Foreign Key: Unidad Vendida
                $table->unsignedInteger("id_unidad")->unique()->comment("Fk Id Unidad del producto");
            //

            /* Llaves Foraneas */
                $table->foreign('id_factura')->references('id')->on('facturas_venta');

                $table->foreign('id_unidad')->references('id')->on('unidades_producto');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_compra');
    }
};
