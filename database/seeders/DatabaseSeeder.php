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

            //Seed: Tipos de documento
            document_typesSeed::class,

            //Seed: Generos/Sexos
            gendersSeed::class,

            //Seed: Areas
            areasSeed::class,

            //Seed: Estados
            statesSeed::class,

            //Seed: Monedas
            currenciesSeed::class,

            //Seed: Categorias
            categoriesSeed::class,

            //Seed: Marcas
            brandsSeed::class,

            //Seed: Productos
            productsSeed::class,

            //Seed: Roles y Permisos
            rolePermissionSeed::class
        ]);

    }
}
