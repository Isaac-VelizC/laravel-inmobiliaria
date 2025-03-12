<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Secretaria']);
        Role::create(['name' => 'Agente']);
        Role::create(['name' => 'Cliente']);
        Role::create(['name' => 'Contador']);

        Permission::create(['name' => 'Administrar Todo']);
        Permission::create(['name' => 'Gestion Usuarios']);
        Permission::create(['name' => 'Gestion Servicios']);
        Permission::create(['name' => 'Crear Propiedad']);
        Permission::create(['name' => 'Editar Propiedad']);
        Permission::create(['name' => 'Borrar Propiedad']);
        Permission::create(['name' => 'Show Propiedad']);
        Permission::create(['name' => 'Crear Citas']);
        Permission::create(['name' => 'Editar Citas']);
        Permission::create(['name' => 'Show Citas']);
        // Asignar permisos al rol admin
        $adminRole = Role::findByName('Admin');
        $adminRole->givePermissionTo('Administrar Todo');
        $adminRole = Role::findByName('Agente');
        $adminRole->givePermissionTo('Administrar Todo');
        // Asignar rol admin al usuario con ID 1
        $userAdmin = User::find(1);
        if ($userAdmin) {
            $userAdmin->assignRole('Admin');
        }
        $userAdmin = User::find(2);
        if ($userAdmin) {
            $userAdmin->assignRole('Admin');
        }
        
        $userSecretaria = User::find(3);
        if ($userSecretaria) {
            $userSecretaria->assignRole('Secretaria');
        }
    }
}
