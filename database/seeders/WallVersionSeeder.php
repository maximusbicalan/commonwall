<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WallVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 3 random wall versions for first freedom wall
        $freedomWall = \App\Models\FreedomWall::query()
            ->orderBy('created_at', 'desc')
            ->first();
        if ($freedomWall) {
            \App\Models\WallVersion::factory()
                ->count(3)
                ->for($freedomWall)
                ->create();
        } else {
            dd('No Freedom Wall found to seed Wall Versions.');
        }

    }
}
