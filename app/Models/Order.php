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
        'quantity',
        'status',
        'notes',
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
}
