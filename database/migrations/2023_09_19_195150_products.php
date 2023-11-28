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
        Schema::create('products', function (Blueprint $table) {
            
            //Llave primaria
            $table->integerIncrements('id')->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->unsignedInteger("brand_id")->comment("Fk Id Marca");

                $table->unsignedInteger("category_id")->comment("Fk Id Categoría");

                $table->string("model")->unique()->comment("Modelo del Producto");

                $table->unsignedInteger('currency_id')->comment("Id Moneda");

                $table->decimal("price",10,2)->comment("Precio unitario del producto");

                $table->string("slug")->unique()->comment("Ruta Url");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves foraneas */
                $table->foreign("brand_id")->references("id")->on("brands");

                $table->foreign("category_id")->references("id")->on("categories");

                $table->foreign('currency_id')->references('id')->on('currencies');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
