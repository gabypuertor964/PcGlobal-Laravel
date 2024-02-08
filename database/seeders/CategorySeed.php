<?php

namespace Database\Seeders;

use App\Helpers\SlugManager;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "categories.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/categories.csv"),"r");

        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            Category::create([
                'name'=> $registro[0],
                'slug'=> SlugManager::generateInString($registro[0])
            ]);
        }
    }
}
