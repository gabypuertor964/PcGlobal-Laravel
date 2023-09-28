<?php

namespace Database\Seeders;

use App\Models\genders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class gendersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "genders.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/genders.csv"),"r");

        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
           genders::create([
                'id'=>null,
                'name'=>$registro[0],
            ]);
        }
    }
}
