<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- Title --}}
        <title>
            @isset($title) {{ $title }} | @endisset
            {{ config('app.name', 'Laravel') }}
        </title>
        <!-- Styles -->
        {{-- Toastr --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- Font-Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Animate.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        {{-- Custom Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles
        {{-- set theme, fix flash --}}
        <script src="{{ asset('js/theme.js') }}"></script>
        <!-- Scripts -->
        {{-- JQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- Alpine JS --}}
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.min.js" integrity="sha512-B/OEIDaWXc61XNJlO0TQILX/mFbhx77bwQKzok6I8suB6WP9yvN8zgaiyLmekPr5eRNmjfpR40zos29ktaSHEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- Toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        {{-- Mouse Trap --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.6.5/mousetrap.min.js"></script>
        {{-- Custom JS --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body
        class="bg-gray-50 dark:bg-dt-darker | font-sans | text-text-color dark:text-dt-text-color | text-sm md:text-normal | subpixel-antialiased | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">

        <!-- Back to top button -->
        <button type="button" data-mdb-ripple="true" data-mdb-ripple-color="light" class="inline-block p-3 bg-rose-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-rose-700 hover:shadow-lg focus:bg-rose-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-rose-800 active:shadow-lg transition duration-150 ease-in-out bottom-5 right-5 z-40" id="btn-back-to-top">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-4 h-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z"></path></svg>
        </button>

        <!-- Loader -->
        @if (!$wloader)
            <x-loader></x-loader>
        @endif

        <div class="flex flex-col h-screen">

            <!-- Page Heading -->
            <header class="bg-white dark:bg-dt-dark shadow |  | fixed w-full z-50 | select-none">
                @include('layouts.partials.app.navigation')
            </header>

            <!-- Page Content -->
            <main class="bg-gray-50 dark:bg-dt-darker | flex-grow | mt-16 {{-- mt-24 en caso de topheaer --}}">
                @if ($breadcrumb)
                    <x-container>
                        <ul class="flex items-center | pt-3 | text-xs md:tex-sm | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
                            @yield('breadcrumb')
                        </ul>
                    </x-container>
                @endif
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            @if (!$wfooter)
                <footer class="bg-gray-200 dark:bg-dt-darkest | dark:text-dt-text-light-color | border-t border-gray-300 dark:border-transparent | pb-3 md:py-6">
                    @include('layouts.partials.app.footer')
                </footer>
            @endif

            @livewire('livewire-ui-modal')
{{--            @livewireUIScripts--}}
            @livewireScripts

            <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>

            @include('cookieConsent::index')
            @include('layouts.partials.toastr')

            @stack('custom-scripts')
            @yield('js')
        </div>
    </body>
</html>
