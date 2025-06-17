<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'min_quantity',
        'max_quantity',
        'charge',
        'is_multiplier',
        'is_active',
    ];
    
    /**
     * Calculate delivery charge based on quantity
     *
     * @param int $quantity
     * @return float
     */
    public static function calculateCharge(int $quantity): float
    {
        $rule = self::where('is_active', true)
            ->where('min_quantity', '<=', $quantity)
            ->where(function ($query) use ($quantity) {
                $query->whereNull('max_quantity')
                    ->orWhere('max_quantity', '>=', $quantity);
            })
            ->first();
            
        if (!$rule) {
            // Default fallback if no rule matches
            return 250.00;
        }
        
        if ($rule->is_multiplier) {
            return $rule->charge * $quantity;
        }
        
        return $rule->charge;
    }
}
