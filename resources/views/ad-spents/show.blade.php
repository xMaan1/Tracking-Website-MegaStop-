<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ad Spent Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('ad-spents.edit', $adSpent) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-fast hover-lift">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </span>
                </a>
                <a href="{{ route('ad-spents.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-fast hover-lift">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg fade-in">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Ad Spent Information</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Details about this ad spent record.</p>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <dl class="divide-y divide-gray-200">
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ date('d M Y', strtotime($adSpent->date)) }}</dd>
                                    </div>
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">Amount</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Rs {{ number_format($adSpent->amount, 2) }}</dd>
                                    </div>
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $adSpent->created_at->format('d M Y, h:i A') }}</dd>
                                    </div>
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $adSpent->updated_at->format('d M Y, h:i A') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Notes</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Additional information about this ad spent.</p>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="prose max-w-none">
                                    <p>{{ $adSpent->notes ?? 'No notes provided.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-red-600">Danger Zone</h3>
                        <div class="mt-4">
                            <form action="{{ route('ad-spents.destroy', $adSpent) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-fast hover-lift" onclick="return confirm('Are you sure you want to delete this record? This action cannot be undone.')">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Delete Ad Spent Record
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>