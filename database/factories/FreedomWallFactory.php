<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FreedomWall>
 */
class FreedomWallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'title' => fake()->sentence(),
            'design_json' => json_encode([
                'backgroundColor' => fake()->hexColor(),
                'elements' => [],
            ]),
            'tags' => json_encode([fake()->word(), fake()->word()]),
            'is_public' => fake()->boolean(),
            'version' => 1,
            'user_id' => null, // This will be set later when creating the wall
        ];
    }
}
