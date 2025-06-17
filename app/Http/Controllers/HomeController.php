<?php

namespace App\Http\Controllers;

use App\Models\AdSpent;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get order statistics
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $dispatchedOrders = $shippedOrders; // "Dispatched" is the same as "Shipped" in this context
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        // Get financial statistics
        $totalSales = Order::sum('sale_amount');
        $totalCosts = Order::sum('order_cost');
        $totalProfit = Order::sum('profit');
        
        // Get ad spent data for current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        $adSpent = AdSpent::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');
        $netProfit = $totalProfit - $adSpent;
        
        // Get monthly order counts for chart
        $chartData = $this->getMonthlyOrderCounts();
        
        return view('dashboard', compact(
            'totalOrders', 
            'pendingOrders', 
            'processingOrders',
            'shippedOrders',
            'dispatchedOrders',
            'deliveredOrders',
            'cancelledOrders',
            'totalSales',
            'totalCosts',
            'totalProfit',
            'adSpent',
            'netProfit',
            'chartData'
        ));
    }
    
    /**
     * Get monthly order counts for the chart
     *
     * @return array
     */
    private function getMonthlyOrderCounts()
    {
        // Get monthly order counts for the chart
        $monthlyOrders = Order::select(
            DB::raw('cast(strftime("%m", created_at) as integer) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->where(DB::raw('strftime("%Y", created_at)'), date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();
        
        // Fill in missing months with zero counts
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[$i] = $monthlyOrders[$i] ?? 0;
        }
        
        return $chartData;
    }

    /**
     * Get dashboard statistics for API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats()
    {
        // Get order statistics
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $dispatchedOrders = $shippedOrders; // "Dispatched" is the same as "Shipped" in this context
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        // Get financial statistics
        $totalSales = Order::sum('sale_amount') ?? 0;
        $totalCosts = Order::sum('order_cost') ?? 0;
        $totalProfit = Order::sum('profit') ?? 0;
        
        // Get ad spent data for current month
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        $adSpent = AdSpent::whereBetween('date', [$startOfMonth, $endOfMonth])->sum('amount');
        $netProfit = $totalProfit - $adSpent;
        
        // Get monthly order counts for chart
        $chartData = $this->getMonthlyOrderCounts();
        
        return response()->json([
            'totalOrders' => $totalOrders, 
            'pendingOrders' => $pendingOrders, 
            'processingOrders' => $processingOrders,
            'shippedOrders' => $shippedOrders,
            'dispatchedOrders' => $dispatchedOrders,
            'deliveredOrders' => $deliveredOrders,
            'cancelledOrders' => $cancelledOrders,
            'totalSales' => $totalSales,
            'totalCosts' => $totalCosts,
            'totalProfit' => $totalProfit,
            'currentMonthAdSpent' => $adSpent,
            'netProfit' => $netProfit,
            'chartData' => $chartData,
        ]);
    }
}
