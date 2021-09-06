<nav x-data="{ showLeftSidebar: false }">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between items-center h-14 mx-4 md:mx-8">
        <div class="flex items-center">
            <!-- Hamburger -->
            <div class="flex items-center md:hidden">
                <button @click="showLeftSidebar = ! showLeftSidebar" class="inline-flex items-center justify-center | font-medium | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': showLeftSidebar, 'inline-flex': ! showLeftSidebar }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! showLeftSidebar, 'inline-flex': showLeftSidebar }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Logo -->
            <div class="md:hidden flex-shrink-0 ml-2">
                <x-link href="{{ route('admin.dashboard') }}" class="flex items-center | focus:no-underline hover:no-underline">
                    <p class="">
                        <span class="text-base font-semibold tracking-tighter | text-title-color dark:text-dt-title-color">Admin</span>
                        <span class="text-base font-semibold tracking-tighter | text-title-color dark:text-dt-title-color">|</span>
                        <span class="text-xs font-normal tracking-tighter | text-title-color dark:text-dt-title-color | uppercase">{{ config('app.name') }}</span>
                    </p>
                </x-link>
            </div>
            <!-- Navigation Links -->
            <ul class="hidden md:flex space-x-6 my-px ">
{{--                 @foreach ($navLinks as $link)
                    <x-nav-link :href="route($link['route-name'])">
                        {{ __($link['text']) }}
                    </x-nav-link>
                @endforeach --}}
            </ul>
        </div>

        <!-- Right links -->
        <div class="flex items-center md:mr-64">

            <!-- Theme selector -->
            <input type="text" id="theme-selection" class="hidden">
            <button class="text-lg | ml-3 | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">
                <label id="theme-selection-label" for="theme-selection">
                    <i class="cursor-pointer" id="theme-selection-icon"></i>
                </label>
            </button>

            <div x-data="{ showRightSidebar: false }">
                <button @click="showRightSidebar = ! showRightSidebar" class="ml-4 inline-flex items-center justify-center | font-medium text-lg | hover:text-title-color dark:hover:text-dt-title-color | focus:outline-none focus:text-title-color dark:focus:text-dt-title-color | transition duration-150 ease-in-out">
                    <i class="fas" :class="{'fa-th-large': !showRightSidebar, 'fa-th-list': showRightSidebar }"></i>
                </button>
                <!-- Responsive Right Sidebar -->
                <div class="absolute right-0 mt-3 w-64 md:mr-64 h-screen z-40 | border border-border-color dark:border-dt-border-color | bg-white dark:bg-dt-darker | overflow-y-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full" id="responsiveRightSidebar" x-show="showRightSidebar"
                    x-transition:enter="transition ease-out origin-top-right duration-100"
                    x-transition:enter-start="opacity-0 transform scale-x-0"
                    x-transition:enter-end="opacity-100 transform scale-x-100"
                    x-transition:leave="transition origin-top-right ease-in duration-100"
                    x-transition:leave-start="opacity-100 transform scale-x-100"
                    x-transition:leave-end="opacity-0 transform scale-x-0">
                    <ul class="px-2 py-1.5 mb-14 " @click.away="showRightSidebar = false">
                        @include('layouts.partials.admin.right-sidebar')
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <!-- Responsive Left Sidebar -->
    <div class="md:hidden absolute w-64 h-screen z-40 |  bg-white dark:bg-dt-dark | border-r border-border-color dark:border-dt-border-color | overflow-y-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full" id="responsiveLeftSidebar" x-show="showLeftSidebar"
        x-transition:enter="transition ease-out origin-top-left duration-100"
        x-transition:enter-start="opacity-0 transform scale-x-0"
        x-transition:enter-end="opacity-100 transform scale-x-100"
        x-transition:leave="transition origin-top-left ease-in duration-100"
        x-transition:leave-start="opacity-100 transform scale-x-100"
        x-transition:leave-end="opacity-0 transform scale-x-0">
        <div class="mb-14" @click.away="showLeftSidebar = false">
            @include('layouts.partials.admin.left-sidebar')
        </div>
    </div>

</nav>