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
        Schema::create('entregas', function (Blueprint $table) {
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
                $table->unsignedInteger('id_factura')->comment("Fk Id Factura");

                $table->unsignedInteger('id_trabajador')->comment("Fk Id Trabajador");

                $table->unsignedInteger('id_tipo_entrega')->comment("Fk Id tipo de entrega");

                $table->unsignedInteger('id_direccion')->comment("Fk Id Direccion");

                $table->datetime('fecha_entrega')->comment("Fecha y Hora entrega");
            //

            //Campos Update_at y Create_at
            $table->timestamps();

            /* Llaves Foraneas */
                $table->foreign('id_factura')->references('id')->on("facturas_venta");

                $table->foreign('id_trabajador')->references('id')->on('users');

                $table->foreign('id_tipo_entrega')->references('id')->on('tipos_entrega');

                $table->foreign('id_direccion')->references('id')->on('direcciones');
            //

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
