<?php

namespace Database\Seeders;

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
                'permissions'=>[
                    'client.create',
                    'client.read',
                    'client.update',
                    'client.delete',
                ]
            ],
            [
                'name'=>'gestor_PQRS',
                'permissions'=>[
                    'pqrs.create',
                    'pqrs.read',
                    'pqrs.update',
                    'pqrs.delete',
                ]
            ],
            [
                'name'=>'repartidor',
                'permissions'=>[
                    'delivery.create',
                    'delivery.read',
                    'delivery.update',
                    'delivery.delete',
                ]
            ],
            [
                'name'=>'almacenista',
                'permissions'=>[
                    'inventory.create',
                    'inventory.read',
                    'inventory.update',
                    'inventory.delete',
                ]
            ],
            [
                'name'=>'gerente',
                'permissions'=>[
                    'gerency.create',
                    'gerency.read',
                    'gerency.update',
                    'gerency.delete',

                    'pqrs.read',
                    'inventory.read',
                    'delivery.read',
                ]
            ],
        ];

        foreach($roles as $rol){

            //Crear el rol
            $role=Role::findOrCreate($rol['name']);

            foreach($rol['permissions'] as $permission_name){

                //Crear o encontrar el permiso
                $permission = Permission::findOrCreate($permission_name);

                //Asignar el permiso al rol
                $role->givePermissionTo($permission);
            }
        }
    }
}
