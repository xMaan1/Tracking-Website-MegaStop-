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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('sale_amount', 10, 2)->nullable()->after('delivery_charge');
            $table->decimal('profit', 10, 2)->nullable()->after('sale_amount');
            $table->date('order_date')->nullable()->after('notes');
        });
        
        Schema::create('ad_spents', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['sale_amount', 'profit', 'order_date']);
        });
        
        Schema::dropIfExists('ad_spents');
    }
};