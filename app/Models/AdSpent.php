<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSpent extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'amount',
        'notes',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];
    
    /**
     * Get total ad spent for a specific date range
     *
     * @param string $startDate
     * @param string $endDate
     * @return float
     */
    public static function getTotalForDateRange($startDate, $endDate): float
    {
        return self::whereBetween('date', [$startDate, $endDate])
            ->sum('amount');
    }
}