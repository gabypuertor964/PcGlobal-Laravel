<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsercionDatosMarcas extends Seeder
{
    public function run()
    {
        // Ruta del archivo CSV. La función (database_path) devuelve la ruta absoluta a la carpeta "database" del proyecto.
        $csvFilePath = database_path('data/Backup_Marcas.csv');
        // Abre el archivo CSV, la 'r' indica que el archivo CSV se abrirá en modo de solo lectura.
        $file = fopen($csvFilePath, 'r');

        // Lee cada línea del archivo CSV
        while (($data = fgetcsv($file)) !== false) {
            // Omitir la primera columna vacía, iniciar desde la columna 1
            $nombre = trim($data[1]);

            // Realiza una inserción en la tabla "marcas" solo si el nombre no está vacío
            if (!empty($nombre)) {
                DB::table('marcas')->insert([
                    'nombre' => $nombre
                ]);
            }
        }

        // Cierra el archivo CSV
        fclose($file);
    }
}