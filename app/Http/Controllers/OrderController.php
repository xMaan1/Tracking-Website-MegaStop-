<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DeliveryCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        
        $orders = $query->latest()->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
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
            'notes' => 'nullable|string',
        ]);
        
        // Generate unique order ID and tracking ID
        $orderId = 'ORD-' . strtoupper(Str::random(8));
        $trackingId = 'TRK-' . strtoupper(Str::random(10));
        
        // Calculate delivery charge based on quantity
        $deliveryCharge = DeliveryCharge::calculateCharge($validated['quantity']);
        
        // Create the order
        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'order_id' => $orderId,
            'tracking_id' => $trackingId,
            'order_cost' => $validated['order_cost'],
            'delivery_charge' => $deliveryCharge,
            'quantity' => $validated['quantity'],
            'status' => 'pending',
            'notes' => $validated['notes'],
        ]);
        
        return redirect()->route('orders.show', $order)
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
            'status' => ['required', Rule::in(['pending', 'dispatched', 'delivered', 'cancelled'])],
            'notes' => 'nullable|string',
        ]);
        
        // Recalculate delivery charge if quantity changed
        if ($order->quantity != $validated['quantity']) {
            $validated['delivery_charge'] = DeliveryCharge::calculateCharge($validated['quantity']);
        }
        
        $order->update($validated);
        
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
        if (!$request->has('tracking_id')) {
            return view('track');
        }
        
        $trackingId = $request->tracking_id;
        $order = Order::where('tracking_id', $trackingId)->first();
        
        if (!$order) {
            return view('track')->with('error', 'No order found with this tracking ID.');
        }
        
        return view('track', compact('order'));
    }
}
