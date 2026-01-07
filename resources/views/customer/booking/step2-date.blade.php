<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Booking - Step 2: Select Date') }}
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
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-bold">3</div>
                        <div class="w-24 h-1 bg-gray-300 mx-2"></div>
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-bold">4</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('customer.booking.storeStep2') }}">
                @csrf
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-6">Select a Date</h3>
                        
                        @if($availableDates->isEmpty())
                            <div class="text-center py-8">
                                <p class="text-gray-600 mb-4">No available dates at the moment.</p>
                                <a href="{{ route('customer.booking.step1') }}" class="text-pink-600 hover:underline">Go back to select service</a>
                            </div>
                        @else
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                @foreach($availableDates as $date)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="booking_date_id" value="{{ $date->id }}" class="hidden peer" required>
                                        <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-pink-500 peer-checked:border-pink-500 peer-checked:bg-pink-50 transition">
                                            <div class="font-semibold">{{ $date->date->format('D') }}</div>
                                            <div class="text-2xl font-bold">{{ $date->date->format('d') }}</div>
                                            <div class="text-sm text-gray-600">{{ $date->date->format('M Y') }}</div>
                                            <div class="text-xs text-gray-500 mt-2">{{ $date->booked_count }}/{{ $date->max_limit }} booked</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            @error('booking_date_id')
                                <p class="text-red-600 mt-4">{{ $message }}</p>
                            @enderror

                            <div class="mt-6 flex justify-between">
                                <a href="{{ route('customer.booking.step1') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Back</a>
                                <x-primary-button>Next: Add Notes</x-primary-button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

