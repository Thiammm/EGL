<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['nom' => 'gestion clientelle']);
        Permission::create(['nom' => 'gestion location']);
        Permission::create(['nom' => 'gestion recettes']);
        Permission::create(['nom' => 'reporting']);
        Permission::create(['nom' => 'gestion inventaire']);
        Permission::create(['nom' => 'recouvrement']);
    }
}
