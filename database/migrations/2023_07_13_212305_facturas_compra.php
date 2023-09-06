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

                Caracteristicas:
                    1.unsignedInteger -> Valores enteros de -2^31 a 2^31-1

                    2.Unsigned -> No acepta valores Negativos

                    3.auto_increment -> Valores Auto Incrementales
                //
            */
            $table->increments('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->datetime("fecha_compra")->unique()->comment("Fecha y Hora ejecucion compra");

                $table->unsignedInteger("id_trabajador_solicitante")->comment("Fk Id Trabajador que realizo la compra");

                $table->datetime("fecha_recibido")->unique()->comment("Fecha y Hora recepcion del pedido");

                $table->unsignedInteger("id_trabajador_receptor")->comment("Fk Id Trabajador que realiza el pedido");

                $table->string("subtotal",10)->comment("Subtotal Factura");

                $table->string("impuestos",10)->comment("Valor Impuestos");

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
