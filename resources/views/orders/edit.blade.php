<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Order') }}
            </h2>
            <a href="{{ route('orders.show', $order) }}" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition-fast hover-lift">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Order
                </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-enter">
                <form action="{{ route('orders.update', $order) }}" method="POST" id="orderForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Customer Information -->
                    <div class="mb-6 stagger-item">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Customer Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $order->customer_name) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect" required>
                                @error('customer_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect" required>
                                @error('customer_phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order IDs -->
                    <div class="mb-6 stagger-item" style="animation-delay: 100ms;">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                            Order Identifiers
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="order_id" class="block text-sm font-medium text-gray-700 mb-1">Order ID</label>
                                <input type="text" id="order_id" value="{{ $order->order_id }}" class="w-full rounded-md border-gray-300 bg-gray-100 shadow-sm input-focus-effect" readonly>
                            </div>
                            <div>
                                <label for="tracking_id" class="block text-sm font-medium text-gray-700 mb-1">Tracking ID</label>
                                <input type="text" id="tracking_id" value="{{ $order->tracking_id }}" class="w-full rounded-md border-gray-300 bg-gray-100 shadow-sm input-focus-effect" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Information -->
                    <div class="mb-6 stagger-item" style="animation-delay: 200ms;">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                            Order Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="order_cost" class="block text-sm font-medium text-gray-700 mb-1">Order Cost (Rs)</label>
                                <input type="number" name="order_cost" id="order_cost" value="{{ old('order_cost', $order->order_cost) }}" step="0.01" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect" required>
                                @error('order_cost')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $order->quantity) }}" min="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect" required>
                                @error('quantity')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect" required>
                                    <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="dispatched" {{ old('status', $order->status) == 'dispatched' ? 'selected' : '' }}>Dispatched</option>
                                    <option value="delivered" {{ old('status', $order->status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="returned" {{ old('status', $order->status) == 'returned' ? 'selected' : '' }}>Returned</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Financial Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="order_date" class="block text-sm font-medium text-gray-700 mb-1">Order Date</label>
                                <input type="date" name="order_date" id="order_date" value="{{ old('order_date', $order->order_date ? $order->order_date->format('Y-m-d') : now()->format('Y-m-d')) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect">
                                @error('order_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="sale_amount" class="block text-sm font-medium text-gray-700 mb-1">Sale Amount (Rs)</label>
                                <div class="relative">
                                    <input type="number" name="sale_amount" id="sale_amount" value="{{ old('sale_amount', $order->sale_amount) }}" step="0.01" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm" id="profit_display">Profit: Rs {{ number_format($order->profit ?? 0, 2) }}</span>
                                    </div>
                                </div>
                                @error('sale_amount')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delivery Charge Information -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-md border border-gray-200 stagger-item" style="animation-delay: 300ms;">
                        <h3 class="text-md font-medium text-gray-900 mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h2a1 1 0 00.9-.5l1.5-2A1 1 0 0015 7h-1V5a1 1 0 00-1-1H3zM14 7h1l-1.5 2H10V7h4z" />
                            </svg>
                            Delivery Charge Information
                        </h3>
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Current Delivery Charge: <span class="font-semibold">Rs {{ number_format($order->delivery_charge, 2) }}</span></p>
                                <p class="text-sm text-gray-600">Current Total Cost: <span class="font-semibold">Rs {{ number_format($order->total_cost, 2) }}</span></p>
                            </div>
                            <div id="newDeliveryChargeInfo" class="mt-3 md:mt-0 md:text-right">
                                <p class="text-sm text-gray-600 mb-1">New Delivery Charge: <span id="newDeliveryCharge" class="font-semibold">Rs {{ number_format($order->delivery_charge, 2) }}</span></p>
                                <p class="text-sm text-gray-600">New Total Cost: <span id="newTotalCost" class="font-semibold">Rs {{ number_format($order->total_cost, 2) }}</span></p>
                            </div>
                            <div id="calculatingIndicator" class="hidden mt-3 md:mt-0">
                                <div class="spinner mr-2"></div>
                                <span class="text-sm text-gray-500">Calculating...</span>
                            </div>
                        </div>
                        <input type="hidden" name="delivery_charge" id="delivery_charge" value="{{ $order->delivery_charge }}">
                    </div>
                    
                    <!-- Notes -->
                    <div class="mb-6 stagger-item" style="animation-delay: 400ms;">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                            Notes (Optional)
                        </h3>
                        <textarea name="notes" id="notes" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 input-focus-effect">{{ old('notes', $order->notes) }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end stagger-item" style="animation-delay: 500ms;">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-fast hover-lift">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                                Update Order
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const orderCostInput = document.getElementById('order_cost');
            const newDeliveryChargeSpan = document.getElementById('newDeliveryCharge');
            const newTotalCostSpan = document.getElementById('newTotalCost');
            const deliveryChargeInput = document.getElementById('delivery_charge');
            const calculatingIndicator = document.getElementById('calculatingIndicator');
            const saleAmountInput = document.getElementById('sale_amount');
            const profitDisplay = document.getElementById('profit_display');
            
            // Function to calculate delivery charge
            const calculateDeliveryCharge = async () => {
                const quantity = parseInt(quantityInput.value) || 0;
                const orderCost = parseFloat(orderCostInput.value) || 0;
                
                if (quantity > 0) {
                    calculatingIndicator.classList.remove('hidden');
                    
                    try {
                        const response = await fetch(`{{ route('delivery-charge.calculate') }}?quantity=${quantity}`);
                        const data = await response.json();
                        
                        if (data.success) {
                            const deliveryCharge = parseFloat(data.delivery_charge);
                            const totalCost = orderCost + deliveryCharge;
                            
                            newDeliveryChargeSpan.textContent = `Rs ${deliveryCharge.toFixed(2)}`;
                            newTotalCostSpan.textContent = `Rs ${totalCost.toFixed(2)}`;
                            deliveryChargeInput.value = deliveryCharge;
                            
                            // Update profit calculation when delivery charge changes
                            calculateProfit();
                        } else {
                            console.error('Error calculating delivery charge:', data.message);
                        }
                    } catch (error) {
                        console.error('Error calculating delivery charge:', error);
                    } finally {
                        calculatingIndicator.classList.add('hidden');
                    }
                }
            };
            
            // Function to calculate profit
            const calculateProfit = () => {
                const saleAmount = parseFloat(saleAmountInput.value) || 0;
                const orderCost = parseFloat(orderCostInput.value) || 0;
                const deliveryCharge = parseFloat(deliveryChargeInput.value) || 0;
                const totalCost = orderCost + deliveryCharge;
                
                if (saleAmount > 0) {
                    const profit = saleAmount - totalCost;
                    profitDisplay.textContent = `Profit: Rs ${profit.toFixed(2)}`;
                    profitDisplay.classList.remove('text-red-500');
                    profitDisplay.classList.add(profit >= 0 ? 'text-green-500' : 'text-red-500');
                } else {
                    profitDisplay.textContent = `Profit: Rs 0.00`;
                    profitDisplay.classList.remove('text-green-500', 'text-red-500');
                    profitDisplay.classList.add('text-gray-500');
                }
            };
            
            // Calculate delivery charge when quantity or order cost changes
            quantityInput.addEventListener('input', calculateDeliveryCharge);
            orderCostInput.addEventListener('input', calculateDeliveryCharge);
            
            // Calculate profit when sale amount changes
            saleAmountInput.addEventListener('input', calculateProfit);
            orderCostInput.addEventListener('input', calculateProfit);
            
            // Initial calculations
            if (parseInt(quantityInput.value) > 0) {
                calculateDeliveryCharge();
            }
            calculateProfit();
        });
    </script>
</x-app-layout>