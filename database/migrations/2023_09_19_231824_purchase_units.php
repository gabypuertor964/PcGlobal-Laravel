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
        Schema::create('purchase_units', function (Blueprint $table) {

            //Llave primaria
            $table->bigInteger('id')->primary()->comment('Llave primaria');

            /* Campos Personalizados */
                $table->unsignedInteger('id_invoice')->comment('Fk Id Factura de compra');

                $table->bigInteger('id_unit')->comment('Fk Id Unidad del producto');
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign('id_invoice')->references('id')->on('purchases');

                $table->foreign('id_unit')->references('id')->on('products_units');
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
