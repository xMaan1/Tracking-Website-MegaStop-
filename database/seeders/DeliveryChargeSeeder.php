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
                'max_quantity' => 1,
                'charge' => 250.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 2,
                'max_quantity' => 2,
                'charge' => 270.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 3,
                'max_quantity' => 3,
                'charge' => 280.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 4,
                'max_quantity' => 5,
                'charge' => 300.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 6,
                'max_quantity' => 7,
                'charge' => 350.00,
                'is_multiplier' => false,
                'is_active' => true,
            ],
            [
                'min_quantity' => 8,
                'max_quantity' => null, // No upper limit
                'charge' => 50.00,
                'is_multiplier' => true,
                'is_active' => true,
            ],
        ];
        
        foreach ($deliveryCharges as $charge) {
            DeliveryCharge::create($charge);
        }
    }
}
