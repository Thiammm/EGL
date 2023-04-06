<?php

namespace Database\Seeders;

use App\Models\StatutLocation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatutLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatutLocation::create(['nom' => 'en-cours']);
        StatutLocation::create(['nom' => 'termine']);
        StatutLocation::create(['nom' => 'credit']);
    }
}
