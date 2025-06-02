<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FreedomWall;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WallVersion>
 */
class WallVersionFactory extends Factory
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
            'wall_id' => FreedomWall::factory(), // Creates a FreedomWall if none provided
            'version' => fake()->numberBetween(1, 10),
            'design_json' => json_encode([
                'backgroundColor' => fake()->hexColor(),
                'elements' => [
                    [
                        'type' => 'text',
                        'content' => fake()->sentence(),
                        'position' => [
                            'x' => fake()->numberBetween(0, 100),
                            'y' => fake()->numberBetween(0, 100)
                        ]
                    ]
                ]
            ]),
        ];
    }

    /**
     * associate with a specific FreedomWall
     */
    public function forFreedomWall(FreedomWall $wall): static
    {
        return $this->state([
            'wall_id' => $wall->id,
            'version' => $wall->versions()->count() + 1, // Increment version based on existing versions
        ]);
    }
}
