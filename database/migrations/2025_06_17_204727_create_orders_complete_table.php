<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the orders table with all fields including returned status and net_profit
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('order_id')->unique();
            $table->string('tracking_id')->unique();
            $table->decimal('order_cost', 10, 2);
            $table->decimal('delivery_charge', 8, 2);
            $table->decimal('sale_amount', 10, 2)->nullable();
            $table->decimal('profit', 10, 2)->nullable();
            $table->decimal('net_profit', 10, 2)->nullable();
            $table->integer('quantity');
            $table->enum('status', ['pending', 'dispatched', 'delivered', 'cancelled', 'returned'])->default('pending');
            $table->text('notes')->nullable();
            $table->date('order_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
