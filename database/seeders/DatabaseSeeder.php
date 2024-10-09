<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Location;
use App\Models\Tenant;
use App\Models\User;
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
            'email' => 'toto@toto.toto'
        ]);

        Tenant::factory()->count(1)->create();
        Box::factory()->count(1)->create();
        Location::factory()->count(1)->create();
    }
}
