<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Box>
 */
class BoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => fake()->numberBetween(1, 2),
            'address' => fake()->address(),
            'name' => fake()->word(),
            'surface' => fake()->numberBetween(1, 100),
            'volume' => fake()->numberBetween(1, 1000),
            'default_price' => fake()->numberBetween(1, 1000),
            'default_deposit' => fake()->numberBetween(1, 1000),
        ];
    }

    /**
     * @param array<int, int> $user
     */
    public function random(int $user): self
    {
        return $this->state(fn(array $attributes) => [
            'owner_id' => fake()->numberBetween(1, $user),
        ]);
    }
}
