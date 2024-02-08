<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla: Facturas de Venta
     */
    public function up(): void
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            
            //Llave primaria
            $table->unsignedInteger('id',true)->comment("Llave Primaria");

            /* Campos personalizados */
                $table->datetime("date_sale")->unique()->comment("Fecha y Hora ejecucion venta");

                $table->bigInteger('id_client')->comment("Id Cliente");

                $table->string("subtotal",10)->comment("Subtotal Factura");

                $table->string("taxes",10)->comment("Valor Impuestos");

                $table->string("total",10)->comment("Valor Total Compra");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves foraneas */
                $table->foreign("id_client")->references('id')->on("users");
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_invoices');
    }
};
