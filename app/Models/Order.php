<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'order_id',
        'tracking_id',
        'order_cost',
        'delivery_charge',
        'sale_amount',
        'profit',
        'quantity',
        'status',
        'notes',
        'order_date',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order_date' => 'date',
        'sale_amount' => 'decimal:2',
        'profit' => 'decimal:2',
    ];
    
    /**
     * Get the formatted status with proper capitalization
     *
     * @return string
     */
    public function getFormattedStatusAttribute()
    {
        return ucfirst($this->status);
    }
    
    /**
     * Get the total cost (order cost + delivery charge)
     *
     * @return float
     */
    public function getTotalCostAttribute()
    {
        return $this->order_cost + $this->delivery_charge;
    }
    
    /**
     * Calculate profit based on sale amount and costs
     */
    public function calculateProfit()
    {
        if ($this->sale_amount) {
            $this->profit = $this->sale_amount - $this->order_cost - $this->delivery_charge;
        }
        return $this->profit;
    }
}
