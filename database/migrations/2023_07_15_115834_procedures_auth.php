<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
            Nombre Procedimiento: PA_consultar_tipos_documento
    
            Objetivo: Consultar la informacion de todos los tipos de documento registrados en la BD
        */
        DB::statement("
            CREATE PROCEDURE PA_consultar_tipos_documento()
            BEGIN
                SELECT
                    *
                FROM tipos_documento;
            END
        ");

        /*
            Nombre Procedimiento: PA_consultar_sexos
    
            Objetivo: Consultar la informacion de todos sexos registrados en la BD
        */
        DB::statement("
            CREATE PROCEDURE PA_consultar_sexos()
            BEGIN
                SELECT
                    *
                FROM sexos;
            END
        ");

        /*
            Nombre Procedimiento: PA_registrar_usuario()
    
            Objetivo: Realizar la creación del nuevo usuario
        */
        DB::statement("
            CREATE PROCEDURE PA_registrar_usuario(
                IN nombres varchar(30),
                IN apellidos varchar(30),
                IN id_sexo int,
                IN id_tip_doc int,
                IN num_doc varchar(15),
                IN num_tel varchar(10),
                IN fecha_nacimiento date,
                IN email varchar(255),
                IN password varchar(255),
                IN timestamps datetime
            )

            BEGIN

                START TRANSACTION;
                    INSERT INTO users VALUES (
                        null,nombres,apellidos,id_sexo,id_tip_doc,num_doc,num_tel,fecha_nacimiento,email,password,null,null,null,null,null,(SELECT id from estados WHERE nombre='Activo'),timestamps,timestamps
                    );
                COMMIT;

            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Borrar el procedimiento PA_consultar_tipos_documento"
        DB::statement("DROP PROCEDURE IF EXISTS PA_consultar_tipos_documento;");

        //Borrar el procedimiento PA_consultar_sexos"
        DB::statement("DROP PROCEDURE IF EXISTS PA_consultar_sexos");

        //Borrar el procedimiento PA_registrar_usuario"
        DB::statement("DROP PROCEDURE IF EXISTS PA_registrar_usuario;");
    }
};