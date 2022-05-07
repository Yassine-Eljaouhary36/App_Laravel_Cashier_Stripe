<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create()->each(
            function($user){
                \App\Models\Service::factory(rand(2,4))->create([
                    'user_id'=>$user->id
                ]);
            }
        );
    }
}
