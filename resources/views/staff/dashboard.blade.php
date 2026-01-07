<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="mb-6">Manage all bookings and update their status.</p>
                    
                    <a href="{{ route('staff.manage') }}" class="bg-pink-500 text-white px-8 py-3 rounded-lg hover:bg-pink-600 transition inline-block">
                        Manage Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

