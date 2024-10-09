<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Box>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'tel' => $this->faker->unique()->phoneNumber(),
            'mail' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'rib' => Str::upper($this->faker->bothify('FR##########??????????????????')),  // Format pour le RIB
            'user_id' =>  1,
        ];
    }
}
