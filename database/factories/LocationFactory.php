<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Box>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'box_id' => 1,
            'tenant_id' => 1,
            'price' => fake()->randomFloat(2, 50, 1000),
            'date_start' => fake()->dateTimeBetween('-1 year', 'now'),
            'date_end' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
