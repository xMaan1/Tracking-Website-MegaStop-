<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Delivery Charge Rule') }}
            </h2>
            <a href="{{ route('delivery-charges.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Back to Rules</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('delivery-charges.update', $deliveryCharge) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Quantity Range -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Quantity Range</h3>
                            
                            <div class="mb-4">
                                <label for="min_quantity" class="block text-sm font-medium text-gray-700 mb-1">Minimum Quantity</label>
                                <input type="number" name="min_quantity" id="min_quantity" value="{{ old('min_quantity', $deliveryCharge->min_quantity) }}" min="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('min_quantity') border-red-500 @enderror" required>
                                @error('min_quantity')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">The minimum quantity this rule applies to.</p>
                            </div>
                            
                            <div class="mb-4">
                                <label for="max_quantity" class="block text-sm font-medium text-gray-700 mb-1">Maximum Quantity</label>
                                <input type="number" name="max_quantity" id="max_quantity" value="{{ old('max_quantity', $deliveryCharge->max_quantity) }}" min="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('max_quantity') border-red-500 @enderror">
                                @error('max_quantity')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Leave empty for no upper limit.</p>
                            </div>
                        </div>
                        
                        <!-- Charge Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Charge Information</h3>
                            
                            <div class="mb-4">
                                <label for="charge" class="block text-sm font-medium text-gray-700 mb-1">Charge Amount (Rs)</label>
                                <input type="number" name="charge" id="charge" value="{{ old('charge', $deliveryCharge->charge) }}" step="0.01" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('charge') border-red-500 @enderror" required>
                                @error('charge')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_multiplier" id="is_multiplier" value="1" {{ old('is_multiplier', $deliveryCharge->is_multiplier) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <label for="is_multiplier" class="ml-2 block text-sm font-medium text-gray-700">Multiply by Quantity</label>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">If checked, the charge will be multiplied by the quantity.</p>
                            </div>
                            
                            <div class="mb-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $deliveryCharge->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <label for="is_active" class="ml-2 block text-sm font-medium text-gray-700">Active</label>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">If unchecked, this rule will not be applied.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('delivery-charges.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Update Rule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>