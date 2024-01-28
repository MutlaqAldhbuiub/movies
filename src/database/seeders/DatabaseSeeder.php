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
        $this->call(UserSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(MovieSeeder::class);
    }
}