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
        Schema::create('products_units', function (Blueprint $table) {

            //Llave primaria
            $table->bigInteger('id')->primary()->comment('Llave primaria');

            /* Campos personalizados */
                    
                //Foreign Key: Producto
                $table->unsignedInteger('id_product')->comment('Fk Id producto');
    
                //Serial de la unidad del producto
                $table->string('serial')->unique()->comment('Serial Unidad del producto');
    
                //Foreign Key: Factura de compra
                $table->unsignedInteger('id_invoice')->comment('Id factura de compra del producto');
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves foraneas */
                $table->foreign('id_product')->references('id')->on('products');

                $table->foreign('id_invoice')->references('id')->on('purchases');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_units');
    }
};
