<?php

namespace Database\Seeders;

use App\Models\sexos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class sexosSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo 'generos.csv' en forma de solo lectura y guardar sus datos en una variable
        $scvGeneros=fopen(database_path("data/generos.csv"),"r");

        /*
            Explicacion: Emplenado un ciclo while y la funcion fgetcsv, se realizara un ciclo el cual accedera a cada registro del archivo csv, para luego realizar su respectivo proceso de guardado en la BD

            Nota: Este proceso se realizara unicamente si hay registros los cuales guardar, en caso de no haber significa que se llego al final del archivo
        */
        while(($registro=fgetcsv($scvGeneros,2000,";"))!=FALSE)
        {
            //Eliminacion caracteres especiales en el campo nombre
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            sexos::create([
                'id'=>null,
                'nombre'=>$registro[0],
            ]);
        }
    }
}
