<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div><p class="text-lg font-medium">Rs {{ number_format($order->delivery_charge, 2) }}</p>ss="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Tracking</h1>
                        <p class="text-gray-600">Enter your tracking ID to check your order status</p>
                    </div>
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    
                    <div class="max-w-md mx-auto bg-gray-50 p-6 rounded-lg shadow-md mb-8">
                        <form action="{{ route('track') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="tracking_id" class="block text-sm font-medium text-gray-700">Tracking ID</label>
                                <input type="text" name="tracking_id" id="tracking_id" value="{{ request('tracking_id') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. TRK-ABCD1234" required>
                            </div>
                            <div>
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Track Order
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    @if(isset($order))
                        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Order Details</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <p class="text-sm text-gray-600">Order ID</p>
                                    <p class="text-lg font-medium">{{ $order->order_id }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Tracking ID</p>
                                    <p class="text-lg font-medium">{{ $order->tracking_id }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Customer Name</p>
                                    <p class="text-lg font-medium">{{ $order->customer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Customer Phone</p>
                                    <p class="text-lg font-medium">{{ $order->customer_phone }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Order Date</p>
                                    <p class="text-lg font-medium">{{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Quantity</p>
                                    <p class="text-lg font-medium">{{ $order->quantity }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Order Cost</p>
                                    <p class="text-lg font-medium">Rs {{ number_format($order->order_cost, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Delivery Charge</p>
                                    <p class="text-lg font-medium">Rs{{ number_format($order->delivery_charge, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Cost</p>
                                    <p class="text-lg font-medium">Rs {{ number_format($order->total_cost, 2) }}</p>
                                </div>
                            </div>
                            
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-2">Order Status</h3>
                                <div class="relative">
                                    <!-- Status bar -->
                                    <div class="h-2 bg-gray-200 rounded-full mb-6">
                                        @php
                                            $statusPercentage = match($order->status) {
                                                'pending' => 25,
                                                'dispatched' => 50,
                                                'delivered' => 100,
                                                'cancelled' => 0,
                                                default => 0
                                            };
                                        @endphp
                                        <div class="h-2 bg-green-500 rounded-full" style="width: {{ $statusPercentage }}%"></div>
                                    </div>
                                    
                                    <!-- Status steps -->
                                    <div class="flex justify-between">
                                        <div class="text-center">
                                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center {{ in_array($order->status, ['pending', 'dispatched', 'delivered']) ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="mt-1 text-sm font-medium">Pending</p>
                                        </div>
                                        <div class="text-center">
                                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center {{ in_array($order->status, ['dispatched', 'delivered']) ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h2.5l2.25-3H16a1 1 0 00-1-1H3zm11 3a1 1 0 00-1 1v1h2.5l-1.5-2z" />
                                                </svg>
                                            </div>
                                            <p class="mt-1 text-sm font-medium">Dispatched</p>
                                        </div>
                                        <div class="text-center">
                                            <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center {{ $order->status == 'delivered' ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                                </svg>
                                            </div>
                                            <p class="mt-1 text-sm font-medium">Delivered</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4 p-3 {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-lg">
                                    <p class="font-medium">Current Status: {{ $order->formatted_status }}</p>
                                    @if($order->status == 'cancelled')
                                        <p class="text-sm mt-1">This order has been cancelled.</p>
                                    @endif
                                </div>
                            </div>
                            
                            @if($order->notes)
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">Notes</h3>
                                    <p class="text-gray-700">{{ $order->notes }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>