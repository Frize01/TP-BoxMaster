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

        User::factory()->create([
            'name' => 'Toto',
            'email' => 'user@test.local',
            'password' => Hash::make('testtt'),
        ]);

        User::factory()->count(9)->create();

        Tenant::factory()->count(50)->create();
        Box::factory()->count(100)->create();
        ModelContract::factory()->count(50)->create();
        Contract::factory()->count(50)->create();
    }
}
