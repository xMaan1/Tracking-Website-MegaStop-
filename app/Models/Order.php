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
        'net_profit',
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
        'net_profit' => 'decimal:2',
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
     * Calculate profit and net profit based on sale amount and costs
     * Net profit accounts for delivery charge deduction on returned orders
     */
    public function calculateProfit()
    {
        if ($this->sale_amount) {
            // Regular profit calculation
            $this->profit = $this->sale_amount - $this->order_cost - $this->delivery_charge;
            
            // Net profit calculation - subtract delivery charge again if order is returned
            $this->net_profit = $this->profit;
            if ($this->status === 'returned') {
                $this->net_profit = $this->profit - $this->delivery_charge;
            }
        }
        return $this->profit;
    }
    
    /**
     * Calculate net profit separately
     * This can be called when just the status changes to 'returned'
     */
    public function calculateNetProfit()
    {
        if ($this->profit) {
            $this->net_profit = $this->profit;
            if ($this->status === 'returned') {
                $this->net_profit = $this->profit - $this->delivery_charge;
            }
        }
        return $this->net_profit;
    }
}
