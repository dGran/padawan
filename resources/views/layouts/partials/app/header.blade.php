<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="w-full fixed border-b border-gray-800 bg-gray-900 z-50">
    <div x-data="{ open: false }" class="flex flex-col custom-container md:items-center md:justify-between md:flex-row">
        <div class="py-4 flex flex-row items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center text-lg font-semibold tracking-wide uppercase focus:outline-none">
                {{-- <img src="https://upload.wikimedia.org/wikipedia/commons/2/29/Embl%C3%A8me_de_l%27Ordre_Jedi.svg" alt="logo" class="w-8 md:w-10 inline-block"> --}}
                <i class="icon-logo text-3xl lg:text-4xl text-orange-500"></i>
                <span class="ml-4 mr-2 hover:text-orange-200">{{ env('APP_NAME') }}</span>
            </a>
            <div class="md:hidden flex">
                @guest
                    @include('layouts.partials.app.guest_menu')
                @endguest
                @auth
                    @include('layouts.partials.app.auth_menu')
                @endauth
                <button class="ml-3 display: inline-flex; md:hidden rounded-lg focus:outline-none" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

        </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row p-3 bg-gray-800 md:bg-transparent md:p-0 rounded mb-4 md:mb-0">
            @include('layouts.partials.app.menu')
        </nav>
    </div>
</div>