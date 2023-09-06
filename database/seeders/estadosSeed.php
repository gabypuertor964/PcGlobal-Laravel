<?php

namespace Database\Seeders;

use App\Models\estados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class estadosSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "estados.csv" y guardarlo en una variable
        $csvEstados=fopen(database_path("data/estados.csv"),"r");

        /*
            Explicacion: Emplenado un ciclo while y la funcion fgetcsv, se realizara un ciclo el cual accedera a cada registro del archivo csv, para luego realizar su respectivo proceso de guardado en la BD

            Nota: Este proceso se realizara unicamente si hay registros los cuales guardar, en caso de no haber significa que se llego al final del archivo
        */
        while(($registro=fgetcsv($csvEstados,2000,";"))!=FALSE){

            //Filtado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en BD
            estados::create([
                'id'=>null,
                'nombre'=>$registro[0],
                'id_area'=>$registro[1]
            ]);
        }
    }
}
