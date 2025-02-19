<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Contract;
use App\Models\ModelContract;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (app()->environment() == 'production') {
            User::factory()->create([
                'name' => 'User 1',
                'email' => 'user.one@test.prod',
                'password' => Hash::make('password'),
            ]);

            User::factory()->create([
                'name' => 'Toto',
                'email' => 'userT.two@test.prod',
                'password' => Hash::make('password'),
            ]);

            Box::factory()->count(20)->create(['owner_id' => 1]);
            Tenant::factory()->count(20)->create(['owner_id' => 1]);

            ModelContract::factory()->count(2)->create([
                'owner_id' => 1,
                'content' => "Content"
            ]);

            foreach (range(1, 20) as $i) {
                Contract::factory()->create([
                    'box_id' => $i,
                    'tenant_id' => $i,
                    'model_contract_id' => fake()->numberBetween(1,2),
                ]);
            }


            exit('Seed production finished');
        }
        User::factory()->create([
            'name' => 'Toto',
            'email' => 'user@test.local',
            'password' => Hash::make('testtt'),
        ]);

        // Seed the tables in the correct order
        User::factory()->count(9)->create();
        Tenant::factory()->count(50)->create();
        Box::factory()->count(100)->create();
        ModelContract::factory()->count(50)->create();
        Contract::factory()->count(50)->create();
    }
}