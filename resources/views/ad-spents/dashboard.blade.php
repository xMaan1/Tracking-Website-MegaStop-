<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Financial Dashboard') }}
            </h2>
            <a href="{{ route('ad-spents.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-fast hover-lift">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Manage Ad Spent
                </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Date Range Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('financial.dashboard') }}" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="$startDate" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="$endDate" />
                        </div>
                        <div class="flex items-end">
                            <x-primary-button class="ml-3">
                                {{ __('Filter') }}
                            </x-primary-button>
                            <a href="{{ route('financial.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3">
                                {{ __('Reset') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Financial Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Sales Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in">
                    <div class="p-6 bg-white border-b border-gray-200 hover-lift transition-fast">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Sales</dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">₹{{ number_format($salesData['total_sales'] ?? 0, 2) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Cost Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in">
                    <div class="p-6 bg-white border-b border-gray-200 hover-lift transition-fast">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Cost</dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">₹{{ number_format($salesData['total_order_cost'] ?? 0, 2) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ad Spent Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in">
                    <div class="p-6 bg-white border-b border-gray-200 hover-lift transition-fast">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                                <svg class="h-8 w-8 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Ad Spent</dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">₹{{ number_format($totalAdSpent, 2) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Net Profit Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in">
                    <div class="p-6 bg-white border-b border-gray-200 hover-lift transition-fast">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 {{ $netProfit > 0 ? 'bg-green-100' : 'bg-red-100' }} rounded-md p-3">
                                <svg class="h-8 w-8 {{ $netProfit > 0 ? 'text-green-600' : 'text-red-600' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Net Profit</dt>
                                    <dd>
                                        <div class="text-lg font-medium {{ $netProfit > 0 ? 'text-green-600' : 'text-red-600' }}">₹{{ number_format($netProfit, 2) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Performance Chart -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Monthly Performance ({{ date('Y') }})</h3>
                    <div class="w-full" style="height: 400px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Monthly Data Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Monthly Breakdown ({{ date('Y') }})</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sales</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profit</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ad Spent</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Profit</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($monthlyData as $data)
                                    <tr class="hover:bg-gray-50 transition-fast">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data['month'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($data['sales'], 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($data['profit'], 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($data['ad_spent'], 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm {{ $data['net_profit'] > 0 ? 'text-green-600' : 'text-red-600' }} font-medium">
                                            ₹{{ number_format($data['net_profit'], 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            
            // Prepare data for chart
            const months = @json(array_column($monthlyData, 'month'));
            const sales = @json(array_column($monthlyData, 'sales'));
            const profits = @json(array_column($monthlyData, 'profit'));
            const adSpent = @json(array_column($monthlyData, 'ad_spent'));
            const netProfits = @json(array_column($monthlyData, 'net_profit'));
            
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Sales',
                            data: sales,
                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                            borderColor: 'rgb(59, 130, 246)',
                            borderWidth: 1
                        },
                        {
                            label: 'Profit',
                            data: profits,
                            backgroundColor: 'rgba(16, 185, 129, 0.5)',
                            borderColor: 'rgb(16, 185, 129)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ad Spent',
                            data: adSpent,
                            backgroundColor: 'rgba(139, 92, 246, 0.5)',
                            borderColor: 'rgb(139, 92, 246)',
                            borderWidth: 1
                        },
                        {
                            label: 'Net Profit',
                            data: netProfits,
                            type: 'line',
                            fill: false,
                            backgroundColor: 'rgba(245, 158, 11, 0.5)',
                            borderColor: 'rgb(245, 158, 11)',
                            borderWidth: 2,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₹' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += '₹' + context.parsed.y.toLocaleString();
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>