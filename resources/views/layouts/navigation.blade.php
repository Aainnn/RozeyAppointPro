<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-14 h-14 bg-pink-500 rounded-full border-2 border-black flex items-center justify-center shadow-md relative">
                            <!-- Scissors -->
                            <svg class="w-6 h-6 text-black absolute -left-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 1 0V3.5h1v3a.5.5 0 0 0 1 0v-3a.5.5 0 0 0-.5-.5h-3zm-2 4a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .146.354l4 4a.5.5 0 0 0 .708 0l4-4A.5.5 0 0 0 16.5 14v-8a.5.5 0 0 0-.5-.5h-9z"/>
                            </svg>
                            <!-- Comb -->
                            <svg class="w-5 h-5 text-black absolute -right-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 2h16v2H4V2zm0 4h16v1H4V6zm0 3h16v1H4V9zm0 3h16v1H4v-1zm0 3h16v1H4v-1zm0 3h16v2H4v-2z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-black leading-tight uppercase">ROZEY</span>
                            <span class="text-2xl font-black text-black leading-tight uppercase">APPOINTPRO</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ml-12 sm:flex items-center">
                    @auth
                        @if(auth()->user()->role === 'customer')
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                                {{ __('HOME') }}
                            </x-nav-link>
                            <x-nav-link :href="route('customer.booking.step1')" :active="request()->routeIs('customer.booking.*')" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                                {{ __('BOOK APPOINTMENT') }}
                            </x-nav-link>
                            <x-nav-link :href="route('customer.my-bookings')" :active="request()->routeIs('customer.my-bookings') || request()->routeIs('customer.bookings.*')" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                                {{ __('MY BOOKINGS') }}
                            </x-nav-link>
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                                {{ __('PROFILE') }}
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'staff')
                            <x-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                                {{ __('DASHBOARD') }}
                            </x-nav-link>
                            <x-nav-link :href="route('staff.manage')" :active="request()->routeIs('staff.manage')" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                                {{ __('MANAGE') }}
                            </x-nav-link>
                            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                                {{ __('PROFILE') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">
                            {{ __('LOGOUT') }}
                        </button>
                    </form>
                @else
                    <div class="space-x-2 flex items-center">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">LOGIN</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-bold text-black uppercase tracking-wide hover:text-pink-600 transition-colors">REGISTER</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->role === 'customer')
                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('customer.booking.step1')" :active="request()->routeIs('customer.booking.*')">
                        {{ __('Make Booking') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('customer.my-bookings')" :active="request()->routeIs('customer.my-bookings')">
                        {{ __('My Bookings') }}
                    </x-responsive-nav-link>
                @elseif(auth()->user()->role === 'staff')
                    <x-responsive-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('staff.manage')" :active="request()->routeIs('staff.manage')">
                        {{ __('Manage') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
