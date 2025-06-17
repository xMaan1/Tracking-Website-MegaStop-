<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ad Spent Management') }}
            </h2>
            <a href="{{ route('ad-spents.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-fast hover-lift">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Ad Spent
                </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Financial Summary Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Financial Summary</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm hover-lift transition-fast">
                            <p class="text-sm text-gray-600">Total Ad Spent</p>
                            <p class="text-2xl font-bold text-indigo-600">Rs {{ number_format($totalAdSpent, 2) }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm hover-lift transition-fast">
                            <p class="text-sm text-gray-600">Total Sales</p>
                            <p class="text-2xl font-bold text-green-600">₹{{ number_format($salesData['total_sales'] ?? 0, 2) }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm hover-lift transition-fast">
                            <p class="text-sm text-gray-600">Net Profit</p>
                            <p class="text-2xl font-bold {{ ($salesData['total_profit'] ?? 0) - $totalAdSpent > 0 ? 'text-green-600' : 'text-red-600' }}">
                                ₹{{ number_format(($salesData['total_profit'] ?? 0) - $totalAdSpent, 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('ad-spents.index') }}" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="request('start_date')" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="request('end_date')" />
                        </div>
                        <div class="flex items-end">
                            <x-primary-button class="ml-3">
                                {{ __('Filter') }}
                            </x-primary-button>
                            <a href="{{ route('ad-spents.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3">
                                {{ __('Reset') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ad Spent Records Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($adSpents as $adSpent)
                                    <tr class="hover:bg-gray-50 transition-fast">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ date('d M Y', strtotime($adSpent->date)) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ₹{{ number_format($adSpent->amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $adSpent->notes ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('ad-spents.edit', $adSpent) }}" class="text-green-600 hover:text-green-900 transition-fast">
                                                    <span class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                        Edit
                                                    </span>
                                                </a>
                                                <form action="{{ route('ad-spents.destroy', $adSpent) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-fast" onclick="return confirm('Are you sure you want to delete this record?')">
                                                        <span class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>
                                                            Delete
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No ad spent records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $adSpents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>