<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Article;
use App\Models\Permission;
use App\Models\TypeArticle;
use Illuminate\Database\Seeder;
use App\Models\ProprieteArticle;
use Database\Factories\TypeArticleFactory;
use Database\Factories\ProprieteArticleFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(100)->create();
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TypeArticlesSeeder::class);
        $this->call(StatutLocationSeeder::class);
        $this->call(DureeLocationSeeder::class);
        Article::factory(100)->create();
        Client::factory(100)->create();
        // TypeArticle::factory(100)->create();
        // ProprieteArticle::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
