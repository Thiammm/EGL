<?php

namespace Database\Seeders;

use App\Models\ProprieteArticle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProprieteArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProprieteArticle::create(['nom' => 'stable',]);
    }
}
