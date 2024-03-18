<?php

namespace Database\Seeders;

use App\Models\PqrsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PqrsTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv=fopen(database_path("data/pqrs_types.csv"),"r");

        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){
            
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            PqrsType::create([
                'name'=>$registro[0],
            ]);
        }
    }
}
