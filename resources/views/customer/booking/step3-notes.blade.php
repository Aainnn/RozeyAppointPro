<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Booking - Step 3: Add Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-center">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-pink-600 text-white font-bold">1</div>
                        <div class="w-24 h-1 bg-pink-600 mx-2"></div>
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-pink-600 text-white font-bold">2</div>
                        <div class="w-24 h-1 bg-pink-600 mx-2"></div>
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-pink-600 text-white font-bold">3</div>
                        <div class="w-24 h-1 bg-pink-600 mx-2"></div>
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-bold">4</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('customer.booking.storeStep3') }}">
                @csrf
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-6">Add Notes (Optional)</h3>
                        
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Special requests or notes:</label>
                            <textarea 
                                id="notes" 
                                name="notes" 
                                rows="6" 
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                                placeholder="Any special requests or notes for your booking...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-between">
                            <a href="{{ route('customer.booking.step2') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Back</a>
                            <x-primary-button>Next: Review</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

