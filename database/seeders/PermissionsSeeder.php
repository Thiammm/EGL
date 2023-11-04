<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'gestion clientelle']);
        Permission::create(['name' => 'gestion location']);
        Permission::create(['name' => 'gestion recettes']);
        Permission::create(['name' => 'reporting']);
        Permission::create(['name' => 'gestion inventaire']);
        Permission::create(['name' => 'recouvrement']);
        Permission::create(['name' => 'affiche dashboard']);
        Permission::create(['name' => 'gestion utilisateurs']);
    }
}
