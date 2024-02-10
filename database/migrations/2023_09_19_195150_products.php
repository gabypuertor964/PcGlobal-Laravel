<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla: Productos
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            
            //Llave primaria
            $table->unsignedBigInteger('id',true)->comment("Llave Primaria");

            /* Campos Personalizados */
                $table->unsignedInteger("brand_id")->comment("Fk Id Marca");

                $table->unsignedInteger("category_id")->comment("Fk Id Categoría");

                $table->string("name")->unique()->comment("Modelo del Producto");

                $table->decimal("price",10,2)->comment("Precio unitario del producto");

                $table->unsignedBigInteger("stock")->comment("Stock del producto")->default(0);

                $table->string("slug")->unique()->comment("Ruta Url");
            //

            //Campos create_at y update_at
            $table->timestamps();

            /* Llaves foraneas */
                $table->foreign("brand_id")->references("id")->on("brands")->onDelete('cascade')->onUpdate('cascade');

                $table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade')->onUpdate('cascade');
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
