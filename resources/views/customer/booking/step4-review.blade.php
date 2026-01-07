<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Booking - Step 4: Review & Submit') }}
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
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-pink-600 text-white font-bold">4</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('customer.booking.submit') }}">
                @csrf
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-6">Review Your Booking</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="border-b pb-4">
                                <h4 class="font-semibold text-gray-700 mb-2">Service:</h4>
                                <p class="text-lg">{{ $service->name }}</p>
                                <p class="text-gray-600">{{ $service->description }}</p>
                            </div>
                            
                            <div class="border-b pb-4">
                                <h4 class="font-semibold text-gray-700 mb-2">Date:</h4>
                                <p class="text-lg">{{ $bookingDate->date->format('l, F d, Y') }}</p>
                            </div>
                            
                            <div class="border-b pb-4">
                                <h4 class="font-semibold text-gray-700 mb-2">Total Price:</h4>
                                <p class="text-2xl font-bold text-pink-600">{{ $service->formatted_price }}</p>
                            </div>
                            
                            @if($notes)
                                <div class="border-b pb-4">
                                    <h4 class="font-semibold text-gray-700 mb-2">Notes:</h4>
                                    <p class="text-gray-600">{{ $notes }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                            <p class="text-sm text-yellow-800">
                                <strong>Note:</strong> Payment will be made at the shop after service completion.
                            </p>
                        </div>

                        <div class="flex justify-between">
                            <a href="{{ route('customer.booking.step3') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Back</a>
                            <x-primary-button>Confirm Booking</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

