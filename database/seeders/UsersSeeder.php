<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach($users as $user){
            $user->assignRole("employe");
        }
        // $user1 = User::find(1);
        // $user1->roles()->attach(1);

        // $user2 = User::find(2);
        // $user2->roles()->attach(2);

        // $user3 = User::find(3);
        // $user3->roles()->attach(3);

        // $user4 = User::find(4);
        // $user4->roles()->attach(4);

    }
}
