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
        /* Ejecucion Seeders globales */
        $this->call([

            //Seed: Tipos de documento
            DocumentTypeSeed::class,

            //Seed: Generos/Sexos
            GenderSeed::class,

            //Seed: Areas
            AreaSeed::class,

            //Seed: Estados
            StateSeed::class,

            //Seed: Roles y Permisos
            RolePermissionSeed::class,

            //Seed: Categorias
            CategorySeed::class,

            //Seed: Marcas
            BrandSeed::class,

            //Seed: Productos
            ProductSeed::class,

            //Seed: Tipos de PQRS
            PqrsTypeSeed::class,
        ]);
    }
}
