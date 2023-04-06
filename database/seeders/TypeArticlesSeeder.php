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
            'nom' => 'Television'
        ]);
        
        TypeArticle::create([
            'nom' => 'Salle'
        ]);

        TypeArticle::create([
            'nom' => 'Bache'
        ]);

        TypeArticle::create([
            'nom' => 'Sonnorisation'
        ]);
    }
}
