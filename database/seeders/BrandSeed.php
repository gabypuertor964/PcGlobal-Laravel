<?php

namespace Database\Seeders;

use App\Helpers\SlugManager;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "brands.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/brands.csv"),"r");

        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            Brand::create([
                'id'=>null,
                'name'=>$registro[0],
                'slug'=>SlugManager::generate(explode(" ",$registro[0]))
            ]);
        }
    }
}
