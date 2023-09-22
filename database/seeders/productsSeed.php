<?php

namespace Database\Seeders;

use App\Models\products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productsSeed extends Seeder
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

            //Guardado del registro en la BD
            products::create([
                'id'=>null,

                'brand_id'=>DB::table('brands')->where('name',$registro[0])->value('id'),

                'category_id'=>DB::table('categories')->where('name',$registro[1])->value('id'),

                'model'=>$registro[2],
                'folder_url'=>$registro[3],

                'currency_id'=>DB::table('currencies')->where('code',$registro[4])->value('id'),

                'price'=>$registro[5],
                'slug'=>$registro[6],
            ]);
        }
    }
}
