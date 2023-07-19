<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'user_type' => 'su_admin',
             'name' => 'Admin principale',
             'user_name' => 'admin14',
             'email' => 'admin@gmail.com',
             'password' => \Hash::make('1234')
         ]);
    }
}
