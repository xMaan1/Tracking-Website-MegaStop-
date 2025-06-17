<?php

namespace Database\Seeders;

use App\Models\DeliveryCharge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing delivery charges
        DeliveryCharge::truncate();
        
        // Create default delivery charge rules
        $deliveryCharges = [
            [
                'min_quantity' => 1,
                'max_quantity' => 5,
                'charge' => 250.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 6,
                'max_quantity' => 10,
                'charge' => 200.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 11,
                'max_quantity' => 20,
                'charge' => 150.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 21,
                'max_quantity' => null, // No upper limit
                'charge' => 100.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
        ];
        
        foreach ($deliveryCharges as $charge) {
            DeliveryCharge::create($charge);
        }
    }
}
