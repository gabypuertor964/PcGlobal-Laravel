<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class rolesPermisosSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abrir el archivo csv en modo de lectura y luego guardarlo en una variable
        $scvTiposDocumento=fopen(database_path("/data/rolesPermisos.csv"),"r");

        /*
            Explicacion: Emplenado un ciclo while y la funcion fgetcsv, se realizara un ciclo el cual accedera a cada registro del archivo csv, para luego realizar su respectivo proceso de guardado en la BD

            Nota: Este proceso se realizara unicamente si hay registros los cuales guardar, en caso de no haber significa que se llego al final del archivo
        */
        while(($registro=fgetcsv($scvTiposDocumento,2000,";"))!=FALSE){

            //Buscar y eliminar algun caracterer especial en el valor de la columna sigla
            $registro[0]=str_replace("﻿","",$registro[0]);

            //Consulta o Creacion rol + Permiso del mismo nombre
            $rol=Role::findOrCreate($registro[0]);
            $permiso=Permission::findOrCreate($registro[0]);

            //Asigancion del permiso al rol
            $rol->syncPermissions([$permiso]);
        }
    }
}
