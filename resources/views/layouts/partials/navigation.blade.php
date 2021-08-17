<nav x-data="{ open: false }" class="bg-gray-100 dark:bg-dark-900 | {{ $blockHeader ? 'border-b dark:border-transparent' : 'shadow' }} | fixed w-full z-50">
    <!-- Primary Navigation Menu -->
    <x-container>
        <div class="flex justify-between items-center h-16">
            <div class="flex">
                <!-- Hamburger -->
                <div class="flex items-center md:hidden mt-1">
                    <button @click="open = ! open" class="inline-flex items-center justify-center | font-medium | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center ml-3 md:ml-0">
                    <x-link href="{{ route('dashboard') }}" class="flex items-center | pt-1 | focus:no-underline hover:no-underline">
                        <i class="icon-logo | text-3xl"></i>
                        <span class="text-base font-semibold leading-4 | uppercase | ml-3">padawan</span>
                    </x-link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 md:-my-px md:ml-10 md:flex select-none">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Torneos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Torneos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Torneos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cookie-policy')" :active="request()->routeIs('cookie-policy')">
                        {{ __('Política de cookies') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center ml-3">

                <input type="text" id="theme-selection" class="hidden">
                <button class="text-xl | pt-1 mr-3 sm:mr-6 | text-gray-500 dark:text-dark-normal | hover:text-gray-700 dark:hover:text-dark-light | focus:outline-none focus:text-gray-700 dark:focus:text-dark-light | transition duration-150 ease-in-out">
                    <label id="theme-selection-label" for="theme-selection">
                        <i class="cursor-pointer" id="theme-selection-icon"></i>
                    </label>
                </button>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-900 | border border-gray-300 dark:border-dark-normal rounded-full | bg-white dark:bg-dark-normal | hover:text-gray-700 hover:border-gray-400 dark:hover:bg-dark-light dark:hover:border-dark-light | focus:outline-none focus:text-gray-700 focus:border-gray-400 dark:focus:bg-dark-light dark:focus:border-dark-light | transition duration-150 ease-in-out | h-8 w-8">
                            @guest
                                <i class="icon-guest text-xl mx-auto"></i>
                            @endguest
                            @auth
                                <i class="icon-user-menu text-xl mx-auto"></i>
                            @endauth
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @guest
                            <x-dropdown-link :href="route('login')" class="border-b dark:border-dark-500">
                                <div class="flex items-center">
                                    <i class="text-md icon-login mr-2"></i>
                                    <span>{{ __('Iniciar sesión') }}</span>
                                </div>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                <div class="flex items-center">
                                    <i class="text-md icon-user-add mr-2"></i>
                                    <span>{{ __('Crear cuenta') }}</span>
                                </div>
                            </x-dropdown-link>
                        @endguest
                        @auth
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <div class="flex items-center">
                                        <i class="text-md icon-logout mr-2"></i>
                                        <span>{{ __('Cerrar sesión') }}</span>
                                    </div>
                                </x-dropdown-link>
                            </form>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </x-container>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden | bg-gray-50 dark:bg-dark-800 | shadow-md" @click.away="open = false">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <x-slot name="icon">pilot</x-slot>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                <x-slot name="icon">arrow-right</x-slot>
                {{ __('Torneos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                <x-slot name="icon">arrow-right</x-slot>
                {{ __('Torneos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                <x-slot name="icon">arrow-right</x-slot>
                {{ __('Torneos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cookie-policy')" :active="request()->routeIs('cookie-policy')">
                <x-slot name="icon">arrow-right</x-slot>
                {{ __('Política de cookies') }}
            </x-responsive-nav-link>

    </div>
</nav>
