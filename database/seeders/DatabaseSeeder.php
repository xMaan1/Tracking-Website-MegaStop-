<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Abdulrehman',
            'email' => 'abdulrehmanbilal25@gmail.com',
            'password' => bcrypt('abdulrehman2555'),
        ]);
        
        // Run the seeders
        $this->call([
            DeliveryChargeSeeder::class,
            AdSpentSeeder::class,
        ]);
    }
}
