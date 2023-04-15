<?php

namespace Database\Seeders;

use App\Models\TypeArticle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeArticle::create([
            'nom' => 'Materiels Electronique'
        ]);
        
        TypeArticle::create([
            'nom' => 'Immobilier'
        ]);

        TypeArticle::create([
            'nom' => 'Transports'
        ]);

        TypeArticle::create([
            'nom' => 'Equipements évènementiels'
        ]);

        TypeArticle::create([
            'nom' => 'Equipements Agricoles'
        ]);
    }
}
