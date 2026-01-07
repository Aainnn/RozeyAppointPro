<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Make Booking - Step 1: Select Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Indicator -->
            <div class="mb-12">
                <div class="flex items-center justify-center">
                    <div class="flex items-center">
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-pink-600 to-purple-600 text-white font-bold shadow-lg">1</div>
                            <p class="text-xs mt-2 text-gray-600 font-medium">Service</p>
                        </div>
                        <div class="w-32 h-1 bg-gradient-to-r from-pink-600 to-purple-600 mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 text-gray-500 font-bold">2</div>
                            <p class="text-xs mt-2 text-gray-500">Date</p>
                        </div>
                        <div class="w-32 h-1 bg-gray-200 mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 text-gray-500 font-bold">3</div>
                            <p class="text-xs mt-2 text-gray-500">Notes</p>
                        </div>
                        <div class="w-32 h-1 bg-gray-200 mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 text-gray-500 font-bold">4</div>
                            <p class="text-xs mt-2 text-gray-500">Review</p>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('customer.booking.storeStep1') }}">
                @csrf
                
                <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                    <div class="p-8">
                        <div class="mb-8">
                            <h3 class="text-3xl font-bold text-gray-900 mb-2">Select a Service</h3>
                            <p class="text-gray-600">Choose the service you'd like to book</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($services as $service)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="service_id" value="{{ $service->id }}" class="hidden peer" required>
                                    <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-pink-500 peer-checked:border-pink-500 peer-checked:bg-gradient-to-br peer-checked:from-pink-50 peer-checked:to-purple-50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg peer-checked:shadow-xl">
                                        <div class="h-40 bg-gradient-to-br from-pink-100 to-purple-100 rounded-lg mb-4 flex items-center justify-center overflow-hidden relative">
                                            @if($service->image)
                                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @else
                                                <svg class="w-16 h-16 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @endif
                                            <div class="absolute top-2 right-2 w-6 h-6 rounded-full bg-white border-2 border-gray-300 peer-checked:border-pink-500 peer-checked:bg-pink-500 flex items-center justify-center transition-all">
                                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <h4 class="font-bold text-lg mb-2 text-gray-900">{{ $service->name }}</h4>
                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($service->description, 80) }}</p>
                                        <p class="text-2xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">{{ $service->formatted_price }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('service_id')
                            <div class="mt-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                                <p class="text-red-700 font-medium">{{ $message }}</p>
                            </div>
                        @enderror

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-pink-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-pink-700 hover:to-purple-700 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center space-x-2">
                                <span>Next: Select Date</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

