<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FreedomWall;
use App\Models\User;

class FreedomWallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $users = User::factory(5)->create();
        $users->each(function ($user) {
            FreedomWall::factory()
                ->count(2)
                ->for($user)
                ->create(); // saves to DB
        });

        // check details of each seeded user and their freedom walls
        foreach ($users as $user) {
            dump([
                'user' => $user->toArray(),
                'freedomWalls' => $user->freedomWalls->toArray(),
            ]);
        }
    }
}
