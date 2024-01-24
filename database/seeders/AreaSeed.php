<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "areas.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/areas.csv"),"r");

        //Iterar sobre el archivo y guardar los registros
        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){

            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            Area::create([
                'id'=>null,
                'name'=>$registro[0]
            ]);
        }
    }
}
