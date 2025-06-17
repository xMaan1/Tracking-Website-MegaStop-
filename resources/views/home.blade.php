<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-800 mb-4">MegaStop Order Tracking</h1>
                        <p class="text-xl text-gray-600">Track your order status in real-time</p>
                    </div>
                    
                    <div class="max-w-md mx-auto bg-gray-50 p-6 rounded-lg shadow-md">
                        <form action="{{ route('track') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="tracking_id" class="block text-sm font-medium text-gray-700">Enter your tracking ID</label>
                                <input type="text" name="tracking_id" id="tracking_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g. TRK-ABCD1234" required>
                            </div>
                            <div>
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Track Order
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="mt-12 text-center">
                        <p class="text-gray-600">Need help? Contact our customer support at support@megastop.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>