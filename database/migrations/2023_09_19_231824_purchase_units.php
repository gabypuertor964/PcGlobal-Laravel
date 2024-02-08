<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table: Unidades de compra
     */
    public function up(): void
    {
        Schema::create('purchase_units', function (Blueprint $table) {

            //Llave primaria
            $table->bigInteger('id',true)->comment('Llave primaria');

            /* Campos Personalizados */
                $table->unsignedInteger('id_invoice')->comment('Fk Id Factura de compra');

                $table->unsignedBigInteger('id_product')->comment('Fk Id del producto');

                $table->unsignedInteger('quantity')->comment('Cantidad de productos');
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign('id_invoice')->references('id')->on('sales_invoices');

                $table->foreign('id_product')->references('id')->on('products');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_units');
    }
};
