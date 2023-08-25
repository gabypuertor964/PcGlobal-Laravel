<?php

namespace Database\Seeders;

use App\Models\areas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class areasSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "areas.csv" y guardar los datos de este en una variable
        $csvAreas=fopen(database_path("data/areas.csv"),"r");

        /*
            Explicacion: Emplenado un ciclo while y la funcion fgetcsv, se realizara un ciclo el cual accedera a cada registro del archivo csv, para luego realizar su respectivo proceso de guardado en la BD

            Nota: Este proceso se realizara unicamente si hay registros los cuales guardar, en caso de no haber significa que se llego al final del archivo
        */
        while(($registro=fgetcsv($csvAreas,2000,";"))!=FALSE){
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            areas::create([
                'id'=>null,
                'nombre'=>$registro[0]
            ]);
        }
    }
}
