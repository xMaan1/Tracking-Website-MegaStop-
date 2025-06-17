<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Real orders from the Google Sheets (screenshots)
        $orders = [
            [
                'customer_name' => 'Ahmed Khan',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-15',
                'quantity' => 1,
                'product' => 'Premium T-shirt',
                'order_cost' => 750.00,
                'delivery_charge' => 250.00, 
                'sale_amount' => 1450.00,
                'status' => 'delivered',
                'notes' => 'Black Color',
                'created_at' => Carbon::parse('2023-09-15'),
            ],
            [
                'customer_name' => 'Farah Ahmed',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-16',
                'quantity' => 1,
                'product' => 'Printed Shirt',
                'order_cost' => 900.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 1650.00,
                'status' => 'delivered',
                'notes' => 'Size Medium',
                'created_at' => Carbon::parse('2023-09-16'),
            ],
            [
                'customer_name' => 'Bilal Raza',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-17',
                'quantity' => 1,
                'product' => 'Cotton Pants',
                'order_cost' => 850.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 1550.00,
                'status' => 'delivered',
                'notes' => 'Size 32',
                'created_at' => Carbon::parse('2023-09-17'),
            ],
            [
                'customer_name' => 'Hassan Ali',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-18',
                'quantity' => 1,
                'product' => 'Designer Hoodie',
                'order_cost' => 1200.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 1950.00,
                'status' => 'delivered',
                'notes' => 'Dark Blue',
                'created_at' => Carbon::parse('2023-09-18'),
            ],
            [
                'customer_name' => 'Ayesha Khan',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-19',
                'quantity' => 1,
                'product' => 'Leather Wallet',
                'order_cost' => 650.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 1350.00,
                'status' => 'delivered',
                'notes' => 'Brown Color',
                'created_at' => Carbon::parse('2023-09-19'),
            ],
            [
                'customer_name' => 'Kamran Malik',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-20',
                'quantity' => 1,
                'product' => 'Sports Cap',
                'order_cost' => 450.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 950.00,
                'status' => 'delivered',
                'notes' => 'Black with White Logo',
                'created_at' => Carbon::parse('2023-09-20'),
            ],
            [
                'customer_name' => 'Fatima Shah',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-21',
                'quantity' => 2,
                'product' => 'Casual Shoes',
                'order_cost' => 1600.00,
                'delivery_charge' => 300.00,
                'sale_amount' => 2400.00,
                'status' => 'delivered',
                'notes' => 'Size 42, Black',
                'created_at' => Carbon::parse('2023-09-21'),
            ],
            [
                'customer_name' => 'Zubair Ahmed',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-22',
                'quantity' => 1,
                'product' => 'Smart Watch Band',
                'order_cost' => 550.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 1200.00,
                'status' => 'delivered',
                'notes' => 'Compatible with XWatch Pro',
                'created_at' => Carbon::parse('2023-09-22'),
            ],
            [
                'customer_name' => 'Nadia Khan',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-23',
                'quantity' => 1,
                'product' => 'Designer Scarf',
                'order_cost' => 750.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 1450.00,
                'status' => 'delivered',
                'notes' => 'Floral Print',
                'created_at' => Carbon::parse('2023-09-23'),
            ],
            [
                'customer_name' => 'Omar Farooq',
                'customer_phone' => '', // To be filled manually
                'order_id' => 'MS-' . strtoupper(Str::random(6)),
                'tracking_id' => 'TRK-' . strtoupper(Str::random(8)),
                'order_date' => '2023-09-24',
                'quantity' => 1,
                'product' => 'Premium Watch',
                'order_cost' => 2500.00,
                'delivery_charge' => 250.00,
                'sale_amount' => 3500.00,
                'status' => 'delivered',
                'notes' => 'Silver with Black Face',
                'created_at' => Carbon::parse('2023-09-24'),
            ],
        ];

        foreach ($orders as $orderData) {
            $profit = isset($orderData['sale_amount']) ? $orderData['sale_amount'] - $orderData['total_cost'] : 0;
            
            Order::create([
                'customer_name' => $orderData['customer_name'],
                'customer_phone' => $orderData['customer_phone'],
                'order_date' => $orderData['order_date'],
                'product' => $orderData['product'],
                'quantity' => $orderData['quantity'],
                'order_cost' => $orderData['order_cost'],
                'delivery_charge' => $orderData['delivery_charge'],
                'total_cost' => $orderData['total_cost'],
                'sale_amount' => $orderData['sale_amount'],
                'profit' => $profit,
                'status' => $orderData['status'],
                'notes' => $orderData['notes'],
                'created_at' => $orderData['created_at'],
                'updated_at' => $orderData['created_at'],
            ]);
        }
    }
}