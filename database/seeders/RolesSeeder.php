<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
        $admin->givePermissionTo('gestion utilisateurs');
    }
}
