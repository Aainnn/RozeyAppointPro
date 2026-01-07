<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-gray-600 mb-4">You don't have any bookings yet.</p>
                        <a href="{{ route('customer.booking.step1') }}" class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 inline-block">
                            Make a Booking
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-6">Your Bookings</h3>
                        
                        <div class="space-y-4">
                            @foreach($bookings as $booking)
                                <div class="border rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="text-xl font-semibold mb-2">{{ $booking->service->name }}</h4>
                                            <div class="space-y-1 text-gray-600">
                                                <p><strong>Date:</strong> {{ $booking->bookingDate->date->format('l, F d, Y') }}</p>
                                                <p><strong>Price:</strong> {{ $booking->service->formatted_price }}</p>
                                                @if($booking->notes)
                                                    <p><strong>Notes:</strong> {{ $booking->notes }}</p>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                                    @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($booking->status === 'completed') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4 space-x-2">
                                            @if($booking->status === 'pending')
                                                <a href="{{ route('customer.bookings.edit', $booking) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">
                                                    Edit
                                                </a>
                                                <form action="{{ route('customer.bookings.destroy', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

