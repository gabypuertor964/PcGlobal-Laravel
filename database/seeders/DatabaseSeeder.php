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
        /* Ejecucion Seeders globales (Ejecucion en Cascada) */
        $this->call([

            //Seed: Tipos de documento
            DocumentTypeSeed::class,

            //Seed: Generos/Sexos
            GenderSeed::class,

            //Seed: Areas
            AreaSeed::class,

            //Seed: Estados
            StateSeed::class,

            //Seed: Monedas
            CurrencySeed::class,

            //Seed: Categorias
            CategorySeed::class,

            //Seed: Marcas
            BrandSeed::class,

            //Seed: Productos
            ProductSeed::class,

            //Seed: Roles y Permisos
            RolePermissionSeed::class,
        ]);

        /**
         * Ejecucion de seeders locales
         * 
        */
        if(env('APP_ENV')=='local'){
            
            //Seed: Usuarios
            $this->call([
                usersSeed::class,
            ]);
        }

    }
}
