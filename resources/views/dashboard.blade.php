<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="dashboard-stat-card border-l-4 border-blue-500 fade-in">
                    <div class="flex items-center">
                        <div class="rounded-full bg-blue-100 p-2 mr-4 flex items-center justify-center" style="width: 36px; height: 36px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm font-medium mb-1">Total Orders</div>
                            <div class="text-3xl font-bold text-gray-800" id="total-orders">{{ $totalOrders }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-stat-card border-l-4 border-yellow-500 fade-in" style="animation-delay: 0.1s">
                    <div class="flex items-center">
                        <div class="rounded-full bg-yellow-100 p-2 mr-4 flex items-center justify-center" style="width: 36px; height: 36px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm font-medium mb-1">Pending Orders</div>
                            <div class="text-3xl font-bold text-yellow-600" id="pending-orders">{{ $pendingOrders }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-stat-card border-l-4 border-purple-500 fade-in" style="animation-delay: 0.2s">
                    <div class="flex items-center">
                        <div class="rounded-full bg-purple-100 p-2 mr-4 flex items-center justify-center" style="width: 36px; height: 36px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm font-medium mb-1">Dispatched Orders</div>
                            <div class="text-3xl font-bold text-purple-600" id="dispatched-orders">{{ $dispatchedOrders }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-stat-card border-l-4 border-green-500 fade-in" style="animation-delay: 0.3s">
                    <div class="flex items-center">
                        <div class="rounded-full bg-green-100 p-2 mr-4 flex items-center justify-center" style="width: 36px; height: 36px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm font-medium mb-1">Delivered Orders</div>
                            <div class="text-3xl font-bold text-green-600" id="delivered-orders">{{ $deliveredOrders }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Financial Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="dashboard-stat-card border-t-4 border-emerald-500 fade-in" style="animation-delay: 0.4s">
                    <div class="text-gray-500 text-sm font-medium mb-1">Total Sales</div>
                    <div class="text-3xl font-bold text-emerald-600" id="total-sales">Rs {{ number_format($totalSales, 2) }}</div>
                    <div class="mt-2 text-sm text-gray-600">Gross revenue from all orders</div>
                </div>
                
                <div class="dashboard-stat-card border-t-4 border-rose-500 fade-in" style="animation-delay: 0.45s">
                    <div class="text-gray-500 text-sm font-medium mb-1">Total Costs</div>
                    <div class="text-3xl font-bold text-rose-600" id="total-costs">Rs {{ number_format($totalCosts, 2) }}</div>
                    <div class="mt-2 text-sm text-gray-600">Product & shipping expenses</div>
                </div>
                
                <div class="dashboard-stat-card border-t-4 border-indigo-500 fade-in" style="animation-delay: 0.5s">
                    <div class="text-gray-500 text-sm font-medium mb-1">Total Profit</div>
                    <div class="text-3xl font-bold text-indigo-600" id="total-profit">Rs {{ number_format($totalProfit, 2) }}</div>
                    <div class="mt-2 text-sm text-gray-600">Net income after expenses</div>
                </div>
            </div>
            
            <!-- Chart -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 mb-8 fade-in" style="animation-delay: 0.55s">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                    </svg>
                    Monthly Orders ({{ date('Y') }})
                </h3>
                <div class="h-80">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 fade-in" style="animation-delay: 0.6s">
                    <h3 class="text-lg font-semibold mb-6 text-gray-800 flex items-center border-b pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('orders.create') }}" class="btn-primary text-center flex flex-col items-center justify-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create Order
                        </a>
                        
                        <a href="{{ route('ad-spents.create') }}" class="btn-secondary text-center flex flex-col items-center justify-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 6.987 6 8c0 1.013.602 1.766 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 13.013 14 12c0-1.013-.602-1.766-1.324-2.246-.48-.32-1.054-.545-1.676-.662V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                            </svg>
                            Add Ad Spent
                        </a>
                        
                        <a href="{{ route('delivery-charges.index') }}" class="btn-outline text-center flex flex-col items-center justify-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                            </svg>
                            Delivery Charges
                        </a>
                        
                        <a href="{{ route('orders.index') }}" class="btn-outline text-center flex flex-col items-center justify-center py-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                            View All Orders
                        </a>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6 fade-in" style="animation-delay: 0.65s">
                    <h3 class="text-lg font-semibold mb-6 text-gray-800 flex items-center border-b pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                        </svg>
                        Recent Changes
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                            <div class="flex-shrink-0 mr-3">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Update</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-700">Delivery charges updated for better pricing</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->subHours(2)->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                            <div class="flex-shrink-0 mr-3">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">New</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-700">Real-time updates and improved UI</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->subDay()->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                            <div class="flex-shrink-0 mr-3">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Fix</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm text-gray-700">Fixed routing issues in the application</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->subDays(2)->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('ordersChart').getContext('2d');
            
            const chartData = @json($chartData);
            const months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            
            // Create gradient for chart background
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.4)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');
            
            const data = {
                labels: months,
                datasets: [{
                    label: 'Orders',
                    data: Object.values(chartData),
                    backgroundColor: gradient,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 3,
                    pointBackgroundColor: 'white',
                    pointBorderColor: 'rgba(59, 130, 246, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4
                }]
            };
            
            window.ordersChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    family: 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif',
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: {
                                family: 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif',
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                family: 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif',
                                size: 13
                            },
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>