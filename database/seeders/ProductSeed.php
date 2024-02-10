<?php

namespace Database\Seeders;

use App\Helpers\SlugManager;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "products.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/products.csv"),"r");

        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){

            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            /* Creacion de directorios y subdirectorios (En caso de ser requerido */

            //Directorio Products
            if(!File::exists(storage_path("app/public/products"))){   
                File::makeDirectory(storage_path("app/public/products"));
            }
            
            $product_directory = strtoupper(SlugManager::generateInString($registro[2]));

            //Directorio producto especifico/individual
            if(!File::exists(storage_path("app/public/products/$product_directory"))){  

                File::makeDirectory(storage_path("app/public/products/$product_directory"));

                File::makeDirectory(storage_path("app/public/products/$product_directory/images"));

                File::put(
                    storage_path("app/public/products/$product_directory/specs.md"),
                    "Descripcion del producto $registro[2]"
                );
            }

            //Guardado del registro en la BD
            Product::create([
                'brand_id'=>DB::table('brands')->where('name',$registro[0])->value('id'),

                'category_id'=>DB::table('categories')->where('name',$registro[1])->value('id'),

                'name'=>$registro[2],

                'price'=>$registro[3],
                'slug'=> strtolower($product_directory),
            ]);
        }
    }
}
