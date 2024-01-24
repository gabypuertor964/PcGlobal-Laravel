<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "currencies.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/currencies.csv"),"r");

        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            Currency::create([
                'id'=>null,
                'name'=>$registro[0],
                'code'=>$registro[1],
                'symbol'=>$registro[2],
            ]);
        }
    }
}
