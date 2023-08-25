<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo csv en modo de lectura y luego guardarlo en una variable
        $scvUsers=fopen(database_path("/data/users.csv"),"r");

        /*
            Explicacion: Emplenado un ciclo while y la funcion fgetcsv, se realizara un ciclo el cual accedera a cada registro del archivo csv, para luego realizar su respectivo proceso de guardado en la BD

            Nota: Este proceso se realizara unicamente si hay registros los cuales guardar, en caso de no haber significa que se llego al final del archivo
        */
        while(($registro=fgetcsv($scvUsers,2000,";"))!=FALSE){
            //Consulta o creacion del rol que ocupara el usuario
            $rol=Role::findByName($registro[10]);
        
            //Buscar y eliminar caracteres especiales en la primera columna de los registros
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Guardado del registro en la BD
            User::create([
                
                'id'=>null,
                'nombres'=>strtoupper($registro[0]),
                'apellidos'=>strtoupper($registro[1]),
                'id_sexo'=>$registro[2],
                'id_tip_doc'=>$registro[3],
                'num_doc'=>$registro[4],
                'num_tel'=>$registro[5],
                'fecha_nacimiento'=>$registro[6],
                'email'=>$registro[7],
                'password'=>Hash::make($registro[8]),
                'id_estado'=>$registro[9]

            ])->assignRole($rol);
        }
    }
}
