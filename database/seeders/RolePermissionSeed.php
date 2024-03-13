<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos de los roles y permisos
        $roles=[
            [
                'name'=>'cliente',
                'permisos'=>[
                    'cliente.create',
                    'cliente.read',
                    'cliente.update',
                    'cliente.delete',
                ]
            ],
            [
                'name'=>'gestor_PQRS',
                'permisos'=>[
                    'pqrs.create',
                    'pqrs.read',
                    'pqrs.update',
                    'pqrs.delete',
                ]
            ],
            [
                'name'=>'vendedor',
                'permisos'=>[
                    'facturation.create',
                    'facturation.read',
                    'facturation.update',
                    'facturation.delete',
                ]
            ],
            [
                'name'=>'almacenista',
                'permisos'=>[
                    'inventory.create',
                    'inventory.read',
                    'inventory.update',
                    'inventory.delete',
                ]
            ],
            [
                'name'=>'gerente',
                'permisos'=>[
                    'gerency.create',
                    'gerency.read',
                    'gerency.update',
                    'gerency.delete',

                    'pqrs.read',
                    'facturation.read',
                    'inventory.read',
                    'delivery.read',
                ]
            ],
        ];

        foreach($roles as $rol){

            //Crear el rol
            $role=Role::findOrCreate($rol['name']);

            foreach($rol['permisos'] as $permiso){

                //Crear o encontrar el permiso
                $permission=Permission::findOrCreate($permiso);

                //Asignar el permiso al rol
                $role->givePermissionTo($permission);
            }
        }
    }
}
