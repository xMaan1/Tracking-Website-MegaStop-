<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCharge;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Search by customer name, phone, order ID or tracking ID
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%")
                  ->orWhere('tracking_id', 'like', "%{$search}%");
            });
        }
        
        // Sort by created_at in descending order (newest first)
        $query->latest();
        
        $orders = $query->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $deliveryCharges = DeliveryCharge::where('is_active', true)->get();
        $today = now()->format('Y-m-d');
        return view('orders.create', compact('deliveryCharges', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'order_cost' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'sale_amount' => 'nullable|numeric|min:0',
            'order_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        
        // Generate unique order ID and tracking ID
        $validated['order_id'] = $this->generateUniqueOrderId();
        $validated['tracking_id'] = $this->generateUniqueTrackingId();
        
        // Set default status
        $validated['status'] = 'pending';
        
        // Calculate delivery charge
        $validated['delivery_charge'] = DeliveryCharge::calculateCharge($validated['quantity']);
        
        // Set order date to today if not provided
        if (empty($validated['order_date'])) {
            $validated['order_date'] = now()->format('Y-m-d');
        }
        
        // Create the order
        $order = Order::create($validated);
        
        // Calculate profit if sale amount is provided
        if (!empty($validated['sale_amount'])) {
            $order->calculateProfit();
            $order->save();
        }
        
        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'order_cost' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'sale_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'notes' => 'nullable|string',
        ]);
        
        // Recalculate delivery charge if quantity changed
        if ($order->quantity != $validated['quantity']) {
            $validated['delivery_charge'] = DeliveryCharge::calculateCharge($validated['quantity']);
        }
        
        // Update the order
        $order->update($validated);
        
        // Recalculate profit if sale amount is provided
        if (!empty($validated['sale_amount'])) {
            $order->calculateProfit();
            $order->save();
        }
        
        return redirect()->route('orders.show', $order)
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        
        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
    
    /**
     * Track an order by tracking ID
     */
    public function track(Request $request)
    {
        $validated = $request->validate([
            'tracking_id' => 'required|string',
        ]);
        
        $order = Order::where('tracking_id', $validated['tracking_id'])->first();
        
        if (!$order) {
            return back()->with('error', 'Order not found with the provided tracking ID.');
        }
        
        return view('track', compact('order'));
    }
    
    /**
     * Generate a unique order ID
     *
     * @return string
     */
    private function generateUniqueOrderId()
    {
        $orderId = 'ORD-' . strtoupper(Str::random(8));
        
        // Check if the generated ID already exists
        while (Order::where('order_id', $orderId)->exists()) {
            $orderId = 'ORD-' . strtoupper(Str::random(8));
        }
        
        return $orderId;
    }

    /**
     * Generate a unique tracking ID
     *
     * @return string
     */
    private function generateUniqueTrackingId()
    {
        $trackingId = 'TRK-' . strtoupper(Str::random(10));
        
        // Check if the generated ID already exists
        while (Order::where('tracking_id', $trackingId)->exists()) {
            $trackingId = 'TRK-' . strtoupper(Str::random(10));
        }
        
        return $trackingId;
    }
}
