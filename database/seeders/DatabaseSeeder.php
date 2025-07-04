<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // $user = User::create([
        //     'name' => 'consultancy admin',
        //     'email' => 'consultancy@admin.com',
        //     'password' => bcrypt('cons@123')
        // ]);
        $this->call(UserTableSeeder::class);
        $this->call(TypeSeeder::class);
        
    }
}
