<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>RozeyAppointPro - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white">
        <div class="min-h-screen">
            @include('layouts.navigation')
            
            <!-- Hero Section with Background Image -->
            <div class="relative h-screen flex items-center -mt-20">
                <!-- Background Image -->
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');"></div>
                <div class="absolute inset-0 bg-black opacity-50"></div>
                
                <!-- Content Overlay -->
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-2xl">
                        <!-- Main Title -->
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white mb-4 uppercase leading-tight">
                            ROZEY APPOINTMENT<br>PRO SYSTEM
                            <span class="text-pink-500 inline-block ml-2">
                                <svg class="w-10 h-10 md:w-14 md:h-14 inline" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 1 0V3.5h1v3a.5.5 0 0 0 1 0v-3a.5.5 0 0 0-.5-.5h-3zm-2 4a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .146.354l4 4a.5.5 0 0 0 .708 0l4-4A.5.5 0 0 0 16.5 14v-8a.5.5 0 0 0-.5-.5h-9z"/>
                                </svg>
                            </span>
                        </h1>
                        
                        <!-- Subtitle -->
                        <p class="text-xl md:text-2xl font-bold text-pink-500 mb-2 uppercase">
                            YOUR STYLE ✌️, YOUR CHOICE 🐾, YOUR BEAUTY 🌸
                        </p>
                        
                        <!-- Availability -->
                        <p class="text-lg md:text-xl font-bold text-white mb-8 uppercase">
                            ANY TIME ANYWHERE "24X7" OPEN
                        </p>
                        
                        <!-- Book Now Button -->
                        @auth
                            @if(auth()->user()->role === 'customer')
                                <a href="{{ route('customer.booking.step1') }}" class="inline-flex items-center px-8 py-4 bg-black text-white font-bold text-lg uppercase tracking-wide rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
                                    MAKE AN APPOINTMENT
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-black text-white font-bold text-lg uppercase tracking-wide rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
                                MAKE AN APPOINTMENT
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- About Us Section -->
            <div class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <!-- Image Side -->
                        <div class="relative">
                            <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="About Rozey Center" class="w-full h-full object-cover">
                            </div>
                        </div>
                        
                        <!-- Content Side -->
                        <div>
                            <h2 class="text-4xl md:text-5xl font-black text-black mb-6 uppercase">ABOUT US</h2>
                            <div class="space-y-4 text-gray-700 leading-relaxed">
                                <p class="text-lg">
                                    Welcome to <span class="font-bold text-pink-600">Rozey Center</span>, where beauty meets wellness. We are dedicated to providing you with the finest beauty and wellness services in a relaxing and professional environment.
                                </p>
                                <p class="text-lg">
                                    Our experienced team of professionals is committed to helping you look and feel your best. From haircuts and styling to nail care and facial treatments, we offer a comprehensive range of services tailored to your needs.
                                </p>
                                <p class="text-lg">
                                    At Rozey Center, we believe that everyone deserves to look and feel their absolute best. Our state-of-the-art facilities and expert staff ensure that every visit is a luxurious experience.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="bg-gray-50 py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl md:text-5xl font-black text-black mb-4 uppercase">OUR SERVICES</h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Discover our range of premium beauty and wellness treatments</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($services as $service)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                                <div class="h-64 bg-gray-200 flex items-center justify-center overflow-hidden">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-2xl font-bold text-black mb-3">{{ $service->name }}</h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 100) }}</p>
                                    <div class="flex items-center justify-between">
                                        <p class="text-2xl font-bold text-pink-600">{{ $service->formatted_price }}</p>
                                        @auth
                                            @if(auth()->user()->role === 'customer')
                                                <a href="{{ route('customer.booking.step1') }}" class="text-black hover:text-pink-600 font-bold uppercase text-sm">
                                                    Book Now →
                                                </a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="bg-black text-white py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl md:text-5xl font-black mb-4 uppercase">CONTACT US</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                        <!-- Contact Information -->
                        <div>
                            <h3 class="text-2xl font-bold mb-6 uppercase">Get in Touch</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-pink-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <a href="mailto:info@rozeycenter.com" class="text-lg hover:text-pink-500 transition-colors">info@rozeycenter.com</a>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-pink-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <a href="tel:+60123456789" class="text-lg hover:text-pink-500 transition-colors">+60 12-345 6789</a>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-pink-500 mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.293 20.293a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-lg">123 Beauty Street,<br>Kuala Lumpur, Malaysia</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div>
                            <h3 class="text-2xl font-bold mb-6 uppercase">Follow Us</h3>
                            <div class="space-y-4">
                                <a href="#" class="flex items-center hover:text-pink-500 transition-colors">
                                    <div class="w-10 h-10 bg-blue-600 rounded flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </div>
                                    <span class="text-lg">Facebook</span>
                                </a>
                                <a href="#" class="flex items-center hover:text-pink-500 transition-colors">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 rounded flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584 0.012 4.85 0.07 3.252.148 4.771 1.691 4.919 4.919.058 1.366.069 1.646.069 4.85 0 3.204-.012 3.584-.069 4.85-.149 3.225-1.664 4.771-4.919 4.919-1.366.058-1.646.07-4.85.07-3.204 0-3.584-.012-4.85-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.366-.07-1.646-.07-4.85 0-3.204.013-3.583.07-4.85.149-3.227 1.664-4.771 4.919-4.919 1.366-.057 1.646-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </div>
                                    <span class="text-lg">Instagram</span>
                                </a>
                                <a href="#" class="flex items-center hover:text-pink-500 transition-colors">
                                    <div class="w-10 h-10 bg-blue-400 rounded flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                        </svg>
                                    </div>
                                    <span class="text-lg">Twitter</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
