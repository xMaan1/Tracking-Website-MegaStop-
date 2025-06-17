<?php

namespace Database\Seeders;

use App\Models\AdSpent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdSpentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records
        AdSpent::truncate();
        
        // Now users can add their own ad spent data through the UI
    }
}
