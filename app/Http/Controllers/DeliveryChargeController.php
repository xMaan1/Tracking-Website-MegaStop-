<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCharge;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryCharges = DeliveryCharge::orderBy('min_quantity')->paginate(10);
        return view('delivery-charges.index', compact('deliveryCharges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('delivery-charges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'min_quantity' => 'required|integer|min:1',
            'max_quantity' => 'nullable|integer|gt:min_quantity',
            'charge' => 'required|numeric|min:0',
            'is_multiplier' => 'boolean',
            'is_active' => 'boolean',
        ]);
        
        // Set default values for checkboxes if not provided
        $validated['is_multiplier'] = $request->has('is_multiplier');
        $validated['is_active'] = $request->has('is_active');
        
        DeliveryCharge::create($validated);
        
        return redirect()->route('delivery-charges.index')
            ->with('success', 'Delivery charge rule created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryCharge $deliveryCharge)
    {
        return view('delivery-charges.show', compact('deliveryCharge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryCharge $deliveryCharge)
    {
        return view('delivery-charges.edit', compact('deliveryCharge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryCharge $deliveryCharge)
    {
        $validated = $request->validate([
            'min_quantity' => 'required|integer|min:1',
            'max_quantity' => 'nullable|integer|gt:min_quantity',
            'charge' => 'required|numeric|min:0',
            'is_multiplier' => 'boolean',
            'is_active' => 'boolean',
        ]);
        
        // Set default values for checkboxes if not provided
        $validated['is_multiplier'] = $request->has('is_multiplier');
        $validated['is_active'] = $request->has('is_active');
        
        $deliveryCharge->update($validated);
        
        return redirect()->route('delivery-charges.index')
            ->with('success', 'Delivery charge rule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryCharge $deliveryCharge)
    {
        $deliveryCharge->delete();
        
        return redirect()->route('delivery-charges.index')
            ->with('success', 'Delivery charge rule deleted successfully!');
    }
    
    /**
     * Calculate delivery charge for a given quantity
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $quantity = $request->quantity;
        $charge = DeliveryCharge::calculateCharge($quantity);
        
        return response()->json([
            'success' => true,
            'quantity' => $quantity,
            'delivery_charge' => $charge,
            'formatted_charge' => number_format($charge, 2),
        ]);
    }
}
