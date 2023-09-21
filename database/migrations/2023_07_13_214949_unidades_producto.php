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
        Schema::create('unidades_producto', function (Blueprint $table) {
            /* 
                Nombre campo: id
                Tipo: Llave Primaria
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */

                //Foreign Key: Producto
                $table->unsignedInteger("id_producto")->comment("Fk Id producto");

                //Serial de la unidad del producto
                $table->string("serial",255)->unique()->comment("Serial Unidad del producto");

                //Foreign Key: Factura de compra
                $table->unsignedInteger('id_factura')->comment('Id factura de compra del producto');
            //

            //Campos Create_at y Update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign("id_producto")->references("id")->on("productos");

                $table->foreign('id_factura')->references("id")->on('facturas_compra');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_producto');
    }
};
