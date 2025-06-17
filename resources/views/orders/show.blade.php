<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('orders.edit', $order) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-fast hover-lift">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Order
                    </span>
                </a>
                <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition-fast hover-lift">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Orders
                    </span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Order Information -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-enter stagger-item">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        Order Information
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Order ID:</p>
                            <p class="font-semibold">{{ $order->order_id }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tracking ID:</p>
                            <p class="font-semibold">{{ $order->tracking_id }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status:</p>
                            <p>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800 status-pulse' : '' }}
                                    {{ $order->status == 'dispatched' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status == 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                ">
                                    {{ $order->formatted_status }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Created:</p>
                            <p class="font-semibold">{{ $order->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Last Updated:</p>
                            <p class="font-semibold">{{ $order->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-enter stagger-item" style="animation-delay: 100ms;">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Customer Information
                    </h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Name:</p>
                            <p class="font-semibold">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Phone:</p>
                            <p class="font-semibold">{{ $order->customer_phone }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-enter stagger-item" style="animation-delay: 200ms;">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                        </svg>
                        Order Details
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Quantity:</p>
                            <p class="font-semibold">{{ $order->quantity }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Order Cost:</p>
                            <p class="font-semibold">Rs {{ number_format($order->order_cost, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Delivery Charge:</p>
                            <p class="font-semibold">Rs {{ number_format($order->delivery_charge, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Cost:</p>
                            <p class="font-semibold text-lg text-indigo-600">Rs {{ number_format($order->total_cost, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Order Date:</p>
                            <p class="font-semibold">{{ $order->order_date ? $order->order_date->format('M d, Y') : 'Not specified' }}</p>
                        </div>
                        @if($order->sale_amount)
                        <div>
                            <p class="text-sm text-gray-600">Sale Amount:</p>
                            <p class="font-semibold">Rs {{ number_format($order->sale_amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Profit:</p>
                            <p class="font-semibold {{ $order->profit > 0 ? 'text-green-600' : 'text-red-600' }}">Rs {{ number_format($order->profit, 2) }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-enter stagger-item" style="animation-delay: 300ms;">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        Notes
                    </h3>
                    <div class="p-3 bg-gray-50 rounded-md">
                        {{ $order->notes ?: 'No notes available.' }}
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 card-enter stagger-item" style="animation-delay: 400ms;">
                <h3 class="text-lg font-medium text-red-600 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Danger Zone
                </h3>
                <div class="border border-red-200 rounded-md p-4">
                    <p class="text-sm text-gray-700 mb-4">Deleting this order will permanently remove it from the system. This action cannot be undone.</p>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-fast hover-lift">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete Order
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>