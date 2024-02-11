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
        // seed genres to the database
        $this->call(RoleSeeder::class); // 1
        $this->call(UserSeeder::class); // 2
        $this->call(GenreSeeder::class); // 3
        $this->call(MovieSeeder::class); // 4
    }
}
