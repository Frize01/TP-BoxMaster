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

        if(app()->environment() == 'production') {
            User::factory()->create([
                'name' => 'User 1',
                'email' => 'userOne@test.prod',
                'password' => Hash::make('password'),
            ]);
            User::factory()->create([
                'name' => 'Toto',
                'email' => 'userTwo@test.prod',
                'password' => Hash::make('password'),
            ]);
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