@php
    $navLinks = [
        ['route-name' => 'gt-sport', 'text' => 'GT Sport', 'class' => '', 'icon' => 'arrow-right'],
        ['route-name' => 'tournament.dashboard', 'text' => 'Torneo de prueba', 'class' => '', 'icon' => 'arrow-right'],
        ['route-name' => 'eteams.index', 'text' => 'Equipos e-sports', 'class' => '', 'icon' => 'arrow-right'],
        ['route-name' => 'cookie-policy', 'text' => 'Merchandising', 'class' => '', 'icon' => 'arrow-right'],
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
                        <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center ml-2 md:ml-0">
                    <x-link href="{{ route('dashboard') }}" class="group | flex items-center | focus:no-underline hover:no-underline">
                        {{-- <i class="icon-logo | text-3xl md:text-4xl"></i> --}}
                        <img src="{{ asset('img/logo2.png') }}" alt="" class="w-auto h-10">
                        <p class="whitespace-nowrap font-ubuntuCondensed tracking-tight text-xl md:text-2xl font-bold | ml-1">
                            @php
                                $appName = explode(' ', config('app.name'));
                            @endphp
                            <span class="text-title-color dark:text-dt-title-color | group-hover:text-black dark:group-hover:text-white | group-focus:text-black dark:group-focus:text-white">
                                {{ $appName[0] }}
                            </span>
                            <span class="text-edblue-500 dark:text-edblue-400 | group-hover:text-edblue-600 dark:group-hover:text-edblue-300 | group-focus:text-edblue-600 dark:group-focus:text-edblue-300">
                                {{ $appName[1] }}
                            </span>
                        </p>
                    </x-link>
                </div>

                <!-- Navigation Links -->
                <ul class="hidden space-x-6 md:-my-px md:ml-10 md:flex">

                    {{-- custom nav-link --}}
{{--                     <li class="menu-item relative inline-flex items-center px-1 text-sm transition duration-150 ease-in-out cursor-pointer" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                            <span>Racing</span>
                            <i class="ml-1 fas fa-angle-down transition duration-150 ease-in-out" x-bind:class="{ 'transform -rotate-180' : open, '' : !open }"></i>
                        </div>
                        <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-12 w-60 | top-0 left-0"
                                style="display: none;"
                                @click="open = false">
                            <div class="bg-white dark:bg-dt-darkest | rounded-md border border-border-color dark:border-dt-dark | overflow-hidden | shadow-md">
                               <div class="">
                                    <x-dropdown-heading>
                                        Torneos
                                    </x-dropdown-heading>

                                    <x-dropdown-link :href="route('login')" class="px-6">
                                        <span>{{ __('GT Racing') }}</span>
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('register')" class="px-6">
                                        <span>{{ __('F1 2022') }}</span>
                                    </x-dropdown-link>

                                    <x-dropdown-heading>
                                        e-Teams
                                    </x-dropdown-heading>

                                    <x-dropdown-link :href="route('register')" class="pl-6">
                                        <span>{{ __('Listado') }}</span>
                                    </x-dropdown-link>

                                    <x-dropdown-divider></x-dropdown-divider>

                                    <x-dropdown-link :href="route('register')" class="pl-6">
                                        <span>{{ __('Listado') }}</span>
                                    </x-dropdown-link>
                                </div>
                            </div>
                        </div>
                    </li> --}}

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
                <div class="text-xl md:text-2xl | mx-4 | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out leading-3 md:leading-5">
                    <input type="text" id="theme-selection" class="hidden">
                    <label id="theme-selection-label" for="theme-selection">
                        <i class="cursor-pointer" id="theme-selection-icon"></i>
                    </label>
                </div>

{{--                 @auth
                    <div class="hidden md:inline-flex text-lg md:text-xl mr-3 relative">
                        <a href="{{ route('notifications') }}" class="hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color">
                            <i class="far fa-bell"></i>
                            @if (auth()->user()->unreadNotifications() > 0)
                                <span class="absolute top-0 right-0 -mr-0.5 -mt-0.5 text-xxs md:text-xs rounded-full w-1 h-1 bg-edyellow-500 text-white animate-ping"></span>
                            @endif
                        </a>
                    </div>
                @endauth --}}

                <!-- User options -->
                <div class="lg:hidden min-w-max">
                    @guest
                        @include('layouts.partials.app.navigation.dropdown-guest')
                    @endguest
                    @auth
                        @include('layouts.partials.app.navigation.dropdown-auth')
                    @endauth
                </div>

                <div class="hidden lg:inline-flex min-w-max">
                    @guest
                        <a class="px-4 py-2 mr-3 | text-sm | hover:bg-border-color dark:hover:bg-dt-darker hover:border-border-color dark:hover:border-dt-darker hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:bg-gray-50 dark:focus:bg-dt-dark-black focus:text-title-color dark:focus:text-dt-title-color | transition duration-75 ease-in-out | rounded-md border border-transparent | select-none | cursor-pointer" href="{{ route('login') }}">
                            Inicia sesión
                        </a>
                        <x-link-button href="{{ route('register') }}">
                            Regístrate!
                        </x-link-button>
                    @endguest
                    @auth
                        @include('layouts.partials.app.navigation.dropdown-auth')
                    @endauth
                </div>

            </div>
        </div>
    </x-container>

    <!-- Responsive Navigation Menu -->
    <div class="md:hidden absolute w-full h-screen bg-gray-50 dark:bg-dt-darker z-40 shadow-md" id="responsiveNavMenu" x-show="open"
        x-transition:enter="transition ease-out origin-top-left duration-100"
        x-transition:enter-start="opacity-0 transform scale-y-0"
        x-transition:enter-end="opacity-100 transform scale-y-100"
        x-transition:leave="transition origin-top-left ease-in duration-100"
        x-transition:leave-start="opacity-100 transform scale-y-100"
        x-transition:leave-end="opacity-0 transform scale-y-0">
        <ul class="bg-white dark:bg-dt-dark | border-b border-border-color dark:border-dt-border-color | w-full" @click.away="open = false">
            @foreach ($navLinks as $link)
                <x-responsive-nav-link :href="route($link['route-name'])">
                    <x-slot name="icon">{{ $link['icon'] }}</x-slot>
                    {{ __($link['text']) }}
                </x-responsive-nav-link>
            @endforeach
        </ul>
    </div>
</nav>
