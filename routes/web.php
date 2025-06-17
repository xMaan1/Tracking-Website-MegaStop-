<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\AdSpentController;
use Illuminate\Support\Facades\Route;

// Dashboard as home route (requires authentication)
Route::middleware(['auth', 'verified'])->get('/', [HomeController::class, 'index'])->name('home');

// Redirect /dashboard to / to maintain backward compatibility
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

// Calculate delivery charge via AJAX (only for authenticated users)
Route::middleware(['auth'])->post('/delivery-charge/calculate', [DeliveryChargeController::class, 'calculate'])->name('delivery-charge.calculate');

// API routes for real-time updates
Route::middleware(['auth'])->prefix('api')->group(function () {
    Route::get('/dashboard/stats', [HomeController::class, 'getStats']);
});

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Orders management
    Route::resource('orders', OrderController::class);
    
    // Delivery charges management
    Route::resource('delivery-charges', DeliveryChargeController::class);
    
    // Ad Spent management
    Route::resource('ad-spents', AdSpentController::class);
    Route::get('/financial-dashboard', [AdSpentController::class, 'dashboard'])->name('financial.dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
