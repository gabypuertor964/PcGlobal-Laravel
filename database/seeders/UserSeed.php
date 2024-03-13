<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo "users.csv" y guardar los datos de este en una variable
        $csv=fopen(database_path("data/users.csv"),"r");

        while(($registro=fgetcsv($csv,3000,";"))!=FALSE){
            
            //Filtrado caracteres especiales
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            User::create([
                'names'=>$registro[0],
                'surnames'=>$registro[1],

                'gender_id'=>DB::table('genders')->where('name',$registro[2])->value('id'),
                'document_type_id'=>DB::table('document_types')->where('name',$registro[3])->value('id'),

                'document_number'=>$registro[4],
                'phone_number'=>$registro[5],
                'date_birth'=>$registro[6],
                'email'=>$registro[7],
                'password'=>Hash::make($registro[8]),
                
            ])->assignRole($registro[9]);
        }
    }
}
