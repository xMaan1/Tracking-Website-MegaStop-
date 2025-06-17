import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Initialize Pusher for realtime updates
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

document.addEventListener('DOMContentLoaded', function() {
    // If we're on the dashboard, listen for order updates
    if (document.getElementById('ordersChart')) {
        window.Echo.channel('orders')
            .listen('OrderStatusUpdated', (e) => {
                updateOrderStats(e.order);
                showNotification('Order Updated', `Order #${e.order.id} status changed to ${e.order.status}`);
            })
            .listen('NewOrderCreated', (e) => {
                updateOrderStats(e.order);
                showNotification('New Order', `New order #${e.order.id} has been created`);
            });
    }
    
    // If we're on the orders page, listen for status changes
    if (document.getElementById('orders-table')) {
        window.Echo.channel('orders')
            .listen('OrderStatusUpdated', (e) => {
                updateOrderRow(e.order);
                showNotification('Order Updated', `Order #${e.order.id} status changed to ${e.order.status}`);
            });
    }
    
    // If we're on the ad-spents page, listen for new ad spents
    if (document.getElementById('ad-spents-table')) {
        window.Echo.channel('ad-spents')
            .listen('AdSpentCreated', (e) => {
                appendAdSpentRow(e.adSpent);
                showNotification('New Ad Spent', `Ad spent of Rs ${e.adSpent.amount} has been added`);
            });
    }
});

// Helper functions for realtime updates
function updateOrderStats(order) {
    // Fetch updated stats via AJAX
    fetch('/api/dashboard/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-orders').textContent = data.totalOrders;
            document.getElementById('pending-orders').textContent = data.pendingOrders;
            document.getElementById('dispatched-orders').textContent = data.dispatchedOrders;
            document.getElementById('delivered-orders').textContent = data.deliveredOrders;            document.getElementById('total-sales').textContent = `Rs ${data.totalSales}`;
            document.getElementById('total-costs').textContent = `Rs ${data.totalCosts}`;
            document.getElementById('total-profit').textContent = `Rs ${data.totalProfit}`;
            
            // Update chart
            if (window.ordersChart) {
                window.ordersChart.data.datasets[0].data = Object.values(data.chartData);
                window.ordersChart.update();
            }
        });
}

function updateOrderRow(order) {
    const row = document.querySelector(`tr[data-order-id="${order.id}"]`);
    if (row) {
        // Update status cell
        const statusCell = row.querySelector('.status-cell');
        if (statusCell) {
            statusCell.textContent = order.status;
            statusCell.className = 'status-cell px-6 py-4 whitespace-nowrap text-sm';
            statusCell.classList.add(getStatusClass(order.status));
        }
        
        // Update last-updated cell
        const updatedCell = row.querySelector('.updated-cell');
        if (updatedCell) {
            updatedCell.textContent = order.updated_at;
        }
        
        // Highlight the row briefly
        row.classList.add('bg-yellow-50');
        setTimeout(() => {
            row.classList.remove('bg-yellow-50');
        }, 3000);
    }
}

function appendAdSpentRow(adSpent) {
    const table = document.getElementById('ad-spents-table');
    if (table) {
        const tbody = table.querySelector('tbody');
        if (tbody) {
            const row = document.createElement('tr');
            row.setAttribute('data-ad-spent-id', adSpent.id);
            row.className = 'table-row-hover stagger-item bg-green-50';
            
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${adSpent.id}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${adSpent.date}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹${adSpent.amount.toFixed(2)}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${adSpent.platform}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${adSpent.description}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="/ad-spents/${adSpent.id}/edit" class="text-green-600 hover:text-green-900 transition-fast">
                        Edit
                    </a>
                    <form action="/ad-spents/${adSpent.id}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4 transition-fast" onclick="return confirm('Are you sure you want to delete this record?')">
                            Delete
                        </button>
                    </form>
                </td>
            `;
            
            tbody.prepend(row);
            
            setTimeout(() => {
                row.classList.remove('bg-green-50');
            }, 5000);
        }
    }
}

function getStatusClass(status) {
    switch (status.toLowerCase()) {
        case 'pending':
            return 'text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full';
        case 'processing':
            return 'text-blue-600 bg-blue-100 px-2 py-1 rounded-full';
        case 'shipped':
            return 'text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full';
        case 'delivered':
            return 'text-green-600 bg-green-100 px-2 py-1 rounded-full';
        case 'cancelled':
            return 'text-red-600 bg-red-100 px-2 py-1 rounded-full';
        default:
            return 'text-gray-600 bg-gray-100 px-2 py-1 rounded-full';
    }
}

function showNotification(title, message) {
    if (!('Notification' in window)) {
        console.log('This browser does not support desktop notification');
        return;
    }
    
    if (Notification.permission === 'granted') {
        const notification = new Notification(title, {
            body: message,
            icon: '/favicon.ico'
        });
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission().then(function (permission) {
            if (permission === 'granted') {
                const notification = new Notification(title, {
                    body: message,
                    icon: '/favicon.ico'
                });
            }
        });
    }
    
    // Also show a toast notification
    showToast(title, message);
}

function showToast(title, message) {
    // Create toast container if it doesn't exist
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'fixed top-4 right-4 z-50 flex flex-col gap-2';
        document.body.appendChild(toastContainer);
    }
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'bg-white shadow-lg rounded-lg p-4 max-w-md flex items-start space-x-3 transform transition-all duration-300 translate-x-full opacity-0';
    toast.style.minWidth = '300px';
    toast.innerHTML = `
        <div class="flex-shrink-0">
            <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="flex-1">
            <p class="font-medium text-gray-900">${title}</p>
            <p class="text-sm text-gray-500">${message}</p>
        </div>
        <button class="text-gray-400 hover:text-gray-600" aria-label="Close">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    `;
    
    // Add toast to container
    toastContainer.appendChild(toast);
    
    // Show the toast
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
    }, 10);
    
    // Add close functionality
    toast.querySelector('button').addEventListener('click', () => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 300);
    });
    
    // Auto-remove after timeout
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 5000);
}
