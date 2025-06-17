<?php

namespace App\Http\Controllers;

use App\Models\AdSpent;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdSpentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AdSpent::query();
        
        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        
        $adSpents = $query->latest('date')->paginate(10);
        
        // Calculate total ad spent
        $totalAdSpent = $adSpents->sum('amount');
        
        // Calculate total sales and profit for the same period
        $dateRange = [];
        if ($request->has('start_date') && $request->has('end_date')) {
            $dateRange = [$request->start_date, $request->end_date];
        }
        
        $salesData = $this->getSalesData($dateRange);
        
        return view('ad-spents.index', compact('adSpents', 'totalAdSpent', 'salesData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ad-spents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        AdSpent::create($validated);
        
        return redirect()->route('ad-spents.index')
            ->with('success', 'Ad spent record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdSpent $adSpent)
    {
        return view('ad-spents.show', compact('adSpent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdSpent $adSpent)
    {
        return view('ad-spents.edit', compact('adSpent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdSpent $adSpent)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        $adSpent->update($validated);
        
        return redirect()->route('ad-spents.index')
            ->with('success', 'Ad spent record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdSpent $adSpent)
    {
        $adSpent->delete();
        
        return redirect()->route('ad-spents.index')
            ->with('success', 'Ad spent record deleted successfully!');
    }
    
    /**
     * Get sales data for dashboard
     */
    private function getSalesData($dateRange = [])
    {
        $query = Order::where('status', '!=', 'cancelled');
        
        if (!empty($dateRange)) {
            $query->whereBetween('order_date', $dateRange);
        }
        
        $totalSales = $query->sum('sale_amount');
        $totalOrderCost = $query->sum('order_cost');
        $totalProfit = $query->sum('profit');
        
        return [
            'total_sales' => $totalSales,
            'total_order_cost' => $totalOrderCost,
            'total_profit' => $totalProfit,
        ];
    }
    
    /**
     * Dashboard for profit and ad spent analytics
     */
    public function dashboard(Request $request)
    {
        // Default to current month if no date range provided
        $startDate = $request->start_date ?? date('Y-m-01');
        $endDate = $request->end_date ?? date('Y-m-t');
        
        // Get ad spent data
        $totalAdSpent = AdSpent::whereBetween('date', [$startDate, $endDate])->sum('amount');
        
        // Get sales data
        $salesData = $this->getSalesData([$startDate, $endDate]);
        
        // Calculate net profit
        $netProfit = $salesData['total_profit'] - $totalAdSpent;
        
        // Get monthly data for chart
        $monthlyData = $this->getMonthlyData();
        
        return view('ad-spents.dashboard', compact(
            'totalAdSpent', 
            'salesData', 
            'netProfit', 
            'monthlyData',
            'startDate',
            'endDate'
        ));
    }
    
    /**
     * Get monthly data for charts
     */
    private function getMonthlyData()
    {
        // Get current year
        $year = date('Y');
        
        // Get monthly sales data
        $monthlySales = Order::select(
            DB::raw('strftime("%m", order_date) as month'),
            DB::raw('SUM(sale_amount) as total_sales'),
            DB::raw('SUM(profit) as total_profit')
        )
        ->whereYear('order_date', $year)
        ->where('status', '!=', 'cancelled')
        ->groupBy('month')
        ->get()
        ->keyBy('month')
        ->toArray();
        
        // Get monthly ad spent data
        $monthlyAdSpent = AdSpent::select(
            DB::raw('strftime("%m", date) as month'),
            DB::raw('SUM(amount) as total_ad_spent')
        )
        ->whereYear('date', $year)
        ->groupBy('month')
        ->get()
        ->keyBy('month')
        ->toArray();
        
        // Combine the data
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, '0', STR_PAD_LEFT);
            $monthlyData[$i] = [
                'month' => date('F', mktime(0, 0, 0, $i, 1)),
                'sales' => $monthlySales[$month]['total_sales'] ?? 0,
                'profit' => $monthlySales[$month]['total_profit'] ?? 0,
                'ad_spent' => $monthlyAdSpent[$month]['total_ad_spent'] ?? 0,
                'net_profit' => ($monthlySales[$month]['total_profit'] ?? 0) - ($monthlyAdSpent[$month]['total_ad_spent'] ?? 0)
            ];
        }
        
        return $monthlyData;
    }
}