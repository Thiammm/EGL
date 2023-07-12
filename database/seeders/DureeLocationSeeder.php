<?php

namespace Database\Seeders;

use App\Models\DureeLocation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DureeLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DureeLocation::create([
            "libelle" => "journée",
            "valeurEnHeure" => 24,
        ]);
        DureeLocation::create([
            "libelle" => "mi-journée",
            "valeurEnHeure" => 14,
        ]);
        DureeLocation::create([
            "libelle" => "hebdomadaire",
            "valeurEnHeure" => 168,
        ]);
    }
}
