<?php

namespace Database\Factories;

use App\Models\Box;
use App\Models\Tenant;
use App\Models\ModelContract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'box_id' => Box::factory(),
            'tenant_id' => Tenant::factory(),
            'price' => fake()->randomFloat(2, 50, 1000),
            'resiliation_delay' => fake()->randomElement(['1 mois', '2 mois', '3 mois']),
            'localisation' => fake()->city(),
            'date_start' => fake()->dateTimeBetween('-1 year', 'now'),
            'date_end' => fake()->dateTimeBetween('now', '+1 year'),
            'model_contract_id' => ModelContract::factory(),
        ];
    }
}
