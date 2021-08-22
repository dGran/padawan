@php
    $navLinks = [
        ['route-name' => 'dashboard', 'text' => 'Dashboard', 'class' => '', 'icon' => 'icon-arrow-right'],
        ['route-name' => 'welcome', 'text' => 'Welcome', 'class' => '', 'icon' => 'icon-arrow-right'],
        ['route-name' => 'cookie-policy', 'text' => 'Política de cookies', 'class' => '', 'icon' => 'icon-arrow-right'],
        // ['href' => '/managers', 'name' => 'managers', 'text' => 'Managers', 'class' => 'hidden lg:inline-flex', 'icon' => 'icon-coach'],
    ]
@endphp

<nav x-data="{ open: false }" class="bg-gray-100 dark:bg-dark-900 | {{ $blockHeader ? 'border-b dark:border-transparent' : 'shadow' }} | fixed w-full z-50 | select-none">
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
                        <i class="icon-logo | text-3xl md:text-4xl"></i>
                        <span class="font-fjalla tracking-wider text-xl md:text-2xl font-semibold leading-4 | uppercase | ml-3">padawan</span>
                        <span class="font-fjalla tracking-wider text-md md:text-base font-semibold leading-4 | uppercase | ml-1.5">e-sports</span>
                    </x-link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 md:-my-px md:ml-10 md:flex">
                    @foreach ($navLinks as $link)
                        <x-nav-link :href="route($link['route-name'])" :active="request()->routeIs($link['route-name'])">
                            {{ __($link['text']) }}
                        </x-nav-link>
                    @endforeach
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
                        <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-900 | border border-gray-300 dark:border-dark-normal rounded-full | bg-white dark:bg-dark-normal | hover:text-gray-700 hover:border-gray-400 dark:hover:bg-dark-light dark:hover:border-dark-light | focus:outline-none focus:text-gray-700 focus:border-gray-400 dark:focus:bg-dark-light dark:focus:border-dark-light | transition duration-150 ease-in-out | h-8 w-8 md:h-10 md:w-10">
                            @guest
                                <i class="icon-guest text-xl md:text-2xl mx-auto"></i>
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
                                    <i class="text-base icon-login mr-3"></i>
                                    <span>{{ __('Iniciar sesión') }}</span>
                                </div>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                <div class="flex items-center">
                                    <i class="text-base icon-user-add mr-3"></i>
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
                                        <i class="text-base icon-logout mr-3"></i>
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
    <div class="md:hidden absolute w-full z-40" id="responsiveNavMenu" x-show="open"
        x-transition:enter="transition ease-out origin-top-left duration-100"
        x-transition:enter-start="opacity-0 transform scale-x-0"
        x-transition:enter-end="opacity-100 transform scale-x-100"
        x-transition:leave="transition origin-top-left ease-in duration-100"
        x-transition:leave-start="opacity-100 transform scale-x-100"
        x-transition:leave-end="opacity-0 transform scale-x-0">
        <div class=" bg-gray-50 dark:bg-dark-800 | shadow-lg | w-full" @click.away="open = false">
            @foreach ($navLinks as $link)
                <x-responsive-nav-link :href="route($link['route-name'])" :active="request()->routeIs($link['route-name'])">
                    <x-slot name="icon">{{ $link['icon'] }}</x-slot>
                    {{ __($link['text']) }}
                </x-responsive-nav-link>
            @endforeach
        </div>
    </div>
</nav>
