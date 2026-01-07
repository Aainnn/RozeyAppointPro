<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('customer.bookings.update', $booking) }}">
                @csrf
                @method('PUT')
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-6">Edit Booking</h3>
                        
                        <div class="space-y-6">
                            <!-- Service Selection -->
                            <div>
                                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">Service:</label>
                                <select id="service_id" name="service_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500" required>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }} - {{ $service->formatted_price }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Selection -->
                            <div>
                                <label for="booking_date_id" class="block text-sm font-medium text-gray-700 mb-2">Date:</label>
                                <select id="booking_date_id" name="booking_date_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500" required>
                                    @foreach($availableDates as $date)
                                        <option value="{{ $date->id }}" {{ $booking->booking_date_id == $date->id ? 'selected' : '' }}>
                                            {{ $date->date->format('l, F d, Y') }} ({{ $date->booked_count }}/{{ $date->max_limit }} booked)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes:</label>
                                <textarea 
                                    id="notes" 
                                    name="notes" 
                                    rows="4" 
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('notes', $booking->notes) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <a href="{{ route('customer.my-bookings') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Cancel</a>
                            <x-primary-button>Update Booking</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

