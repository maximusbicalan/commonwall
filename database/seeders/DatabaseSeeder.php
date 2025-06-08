<?php

namespace Database\Seeders;

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
        $this->call([
            
            UserSeeder::class, // seeds users
            FreedomWallSeeder::class, // seeds users and their freedom walls
            WallVersionSeeder::class, // seeds wall versions for the first most recent freedom wall
        ]);

    }
}
