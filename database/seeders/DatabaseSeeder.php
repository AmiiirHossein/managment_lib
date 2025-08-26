<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
        ]);

        // Create a regular member user
        User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@library.com',
        ]);

        // Create 20 random member users
        User::factory(20)->create();

        // Create 10 books
        Book::factory(10)->create();
    }

}
