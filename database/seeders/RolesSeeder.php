<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employe = Role::create(['name' => 'employe']);
        $manager = Role::create(['name' => 'manager']);
        $admin = Role::create(['name' => 'admin']);
        $superAdmin = Role::create(['name' => 'super-admin']);

        $permissionsEmploye = Permission::all()->whereIn('name', ['gestion clientelle', 'gestion location', 'gestion inventaire', 'recouvrement']);
        $employe->syncPermissions($permissionsEmploye);
        $admin->givePermissionTo('affiche dashboard');
    }
}
