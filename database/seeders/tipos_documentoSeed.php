<?php

namespace Database\Seeders;

use App\Models\tipos_documento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipos_documentoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo csv en modo de lectura y luego guardarlo en una variable
        $scvTiposDocumento=fopen(database_path("/data/tipos_documento.csv"),"r");

        /*
            Explicacion: Emplenado un ciclo while y la funcion fgetcsv, se realizara un ciclo el cual accedera a cada registro del archivo csv, para luego realizar su respectivo proceso de guardado en la BD

            Nota: Este proceso se realizara unicamente si hay registros los cuales guardar, en caso de no haber significa que se llego al final del archivo
        */
        while(($registro=fgetcsv($scvTiposDocumento,2000,";"))!=FALSE){

            //Buscar y eliminar algun caracterer especial en el valor de la columna sigla
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            tipos_documento::create([
                'id'=>null,
                'nombre'=>$registro[1],
                'siglas'=>$registro[0]
            ]);
        }
    }
}
