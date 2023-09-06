<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Ejecucion Seeders (Ejecucion en Cascada) */
        $this->call([

            //Llenado tabla: tipos_documento
            tipos_documentoSeed::class,

            //Llenado tabla: sexos
            sexosSeed::class,

            //Llenado tabla: areas
            areasSeed::class,

            //Llenado tabla: estados
            estadosSeed::class,

            //Llenado tablas: permisos + roles
            rolesPermisosSeed::class,

            //Llenado tabla: users
            userSeed::class,

            //Llenado tabla: marcas
            InsercionDatosMarcas::class,

            //Llenado tabla: categorias
            RegistrosCategorias::class,

            //Llenado tabla: productos
            productos::class,

        ]);

    }
}
