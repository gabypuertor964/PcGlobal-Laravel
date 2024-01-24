<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\states;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "states.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/states.csv"),"r");

        while(($registro=fgetcsv($csv,2000,";"))!=FALSE){
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            State::create([
                'id'=>null,
                'name'=>$registro[0],
                'area_id'=>DB::table('areas')->where('name',$registro[1])->value('id')
            ]);
        }
    }
}
