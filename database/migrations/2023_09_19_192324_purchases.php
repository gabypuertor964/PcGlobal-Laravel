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
        Schema::create('purchases', function (Blueprint $table) {
            
            //Llave primaria
            $table->integerIncrements('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->unsignedInteger("applicant_worker_id")->comment("Fk Id Trabajador que realizo la compra");

                $table->date("date_purchase")->comment("Fecha ejecucion compra");

                $table->unsignedInteger("currency_id")->comment("Id Moneda");

                $table->string("subtotal",10)->comment("Subtotal Factura");

                $table->string("taxes",10)->comment("Valor Impuestos");

                $table->string("total",10)->comment("Valor Total Compra");

                $table->unsignedInteger("receiver_worker_id")->nullable()->comment("Fk Id Trabajador que realiza el pedido");

                $table->datetime("date_received")->nullable()->comment("Fecha recepcion del pedido");

                $table->string("url_scanner",100)->comment("URL de la Factura");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves Foraneas */

            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
