@php
    $navLinks = [
        ['route-name' => 'dashboard', 'text' => 'Dashboard', 'class' => '', 'icon' => 'icon-arrow-right'],
        ['route-name' => 'welcome', 'text' => 'Welcome', 'class' => '', 'icon' => 'icon-arrow-right'],
        ['route-name' => 'cookie-policy', 'text' => 'Política de cookies', 'class' => '', 'icon' => 'icon-arrow-right'],
        // ['href' => '/managers', 'name' => 'managers', 'text' => 'Managers', 'class' => 'hidden lg:inline-flex', 'icon' => 'icon-coach'],
    ]
@endphp

<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <x-container>
        <div class="flex justify-between items-center h-16">
            <div class="flex">
                <!-- Hamburger -->
                <div class="flex items-center md:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center | font-medium | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center ml-3 md:ml-0">
                    <x-link href="{{ route('dashboard') }}" class="flex items-center | focus:no-underline hover:no-underline">
                        <i class="icon-logo | text-3xl md:text-4xl"></i>
                        <span class="text-base md:text-lg font-bold tracking-tighter | text-title-color dark:text-dt-title-color | ml-1.5">{{ config('app.name') }}</span>
                        {{-- <span class="font-fjalla tracking-wider text-md md:text-base font-semibold leading-4 | uppercase | ml-1.5">e-sports</span> --}}
                    </x-link>
                </div>

                <!-- Navigation Links -->
                <ul class="hidden space-x-6 md:-my-px md:ml-10 md:flex">
                    @foreach ($navLinks as $link)
                        <x-nav-link :href="route($link['route-name'])">
                            {{ __($link['text']) }}
                        </x-nav-link>
                    @endforeach
                </ul>
            </div>

            <!-- Right links -->
            <div class="flex items-center">

                <!-- Theme selector -->
                <input type="text" id="theme-selection" class="hidden">
                <button class="text-xl md:text-2xl | pt-1 mx-3 | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">
                    <label id="theme-selection-label" for="theme-selection">
                        <i class="cursor-pointer" id="theme-selection-icon"></i>
                    </label>
                </button>

                <!-- User options -->
                <div class="lg:hidden">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm | rounded-full | h-10 w-10 md:h-12 md:w-12 | hover:bg-border-color dark:hover:bg-dt-border-color hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:bg-border-color dark:focus:bg-dt-border-color focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out | border border-border-color dark:border-dt-border-color">
                                @guest
                                    <i class="icon-guest text-2xl md:text-3xl mx-auto"></i>
                                @endguest
                                @auth
                                    <i class="icon-user-menu text-2xl mx-auto"></i>
                                @endauth
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @guest
                                <x-dropdown-link :href="route('login')">
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

                <div class="hidden lg:inline-flex">
                    <a class="px-4 py-2 mr-3 | text-sm | rounded-md border border-transparent | hover:bg-border-color dark:hover:bg-dt-border-color hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:bg-border-color dark:focus:bg-dt-border-color focus:text-title-color dark:focus:text-dt-title-color | disabled:opacity-25 | transition ease-in-out duration-75 | select-none | cursor-pointer" href="{{ route('login') }}">
                        Inicia sesión
                    </a>
                    <x-button class="">
                        Regístrate!
                    </x-button>
                </div>

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
        <ul class="bg-white dark:bg-dt-dark | shadow-bottom dark:shadow-none | border-b border-border-color dark:border-dt-border-color | w-full" @click.away="open = false">
            @foreach ($navLinks as $link)
                <x-responsive-nav-link :href="route($link['route-name'])">
                    <x-slot name="icon">{{ $link['icon'] }}</x-slot>
                    {{ __($link['text']) }}
                </x-responsive-nav-link>
            @endforeach
        </ul>
    </div>
</nav>
