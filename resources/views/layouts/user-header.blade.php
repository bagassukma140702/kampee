<header x-data="{ isMenuOpen: false }" class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('storage/logo.png') }}" alt="logo" class="w-8 h-8">
                <span class="text-2xl font-bold text-gray-900">Kampee</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('home') ? 'text-emerald-600' : 'text-gray-700' }}">
                    Beranda
                </a>
                <a href="{{ route('user.fasilitas.index') }}"
                    class="text-sm font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('user.fasilitas.index') ? 'text-emerald-600' : 'text-gray-700' }}">
                    Fasilitas
                </a>
                <a href="{{ route('user.paket-wisata.index') }}"
                    class="text-sm font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('user.paket-wisata.index') || request()->routeIs('user.pemesanan.form') || request()->routeIs('user.paket-wisata.show') ? 'text-emerald-600' : 'text-gray-700' }}">
                    Paket Wisata
                </a>
                @auth
                    @if (Auth::user()->hasRole('user'))
                        <a href="{{ route('user.pemesanan.index') }}"
                            class="text-sm font-medium transition-colors hover:text-emerald-600 {{ request()->routeIs('user.pemesanan.index') || request()->routeIs('user.pemesanan.show') ? 'text-emerald-600' : 'text-gray-700' }}">
                            Pesanan Saya
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium transition-colors hover:text-emerald-600 text-gray-700">
                        Pesanan Saya
                    </a>
                @endauth

                @auth
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm font-medium transition-colors hover:text-emerald-600 text-gray-700">
                            Admin
                        </a>
                    @endif
                @endauth
            </nav>

            <!-- User Menu -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-white px-4 py-2 rounded-md flex items-center bg-emerald-500 hover:bg-emerald-600">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Masuk
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <button @click="isMenuOpen = !isMenuOpen" class="md:hidden text-gray-500 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="isMenuOpen" class="md:hidden border-t border-gray-200 py-4">
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium text-gray-700 hover:text-emerald-600 {{ request()->routeIs('home') ? 'text-emerald-600' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('user.paket-wisata.index') }}"
                    class="text-sm font-medium text-gray-700 hover:text-emerald-600 {{ request()->routeIs('user.paket-wisata.index') ? 'text-emerald-600' : '' }}">
                    Paket Wisata
                </a>
                <a href="{{ route('user.pemesanan.index') }}"
                    class="text-sm font-medium text-gray-700 hover:text-emerald-600 {{ request()->routeIs('user.pemesanan.index') ? 'text-emerald-600' : '' }}">
                    Pesanan Saya
                </a>
                @auth
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm font-medium text-gray-700 hover:text-emerald-600 {{ request()->routeIs('*') ? 'text-emerald-600' : '' }}">
                            Admin
                        </a>
                    @endif
                @endauth

                @auth
                    <div class="pt-2 border-t border-gray-200">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('profile.edit') }}"
                                class="block text-sm text-gray-700 hover:text-emerald-600">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block text-sm text-gray-700 hover:text-emerald-600">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="w-fit px-3 py-1 border border-gray-300 rounded-md text-sm flex items-center text-gray-700 hover:bg-gray-50">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Masuk
                    </a>
                @endauth
            </nav>
        </div>
    </div>
</header>
