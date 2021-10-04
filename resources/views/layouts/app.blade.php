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
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles
        <!-- Scripts -->
            {{-- JQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            {{-- Toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>

    <body
        class="bg-gray-50 dark:bg-dt-darker | font-sans | text-text-color dark:text-dt-text-color | text-sm md:text-normal | subpixel-antialiased | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">

        <!-- Loader -->
        @if (!$wloader)
            <x-loader></x-loader>
        @endif

        <div class="flex flex-col h-screen">

            <!-- Page Heading -->
            <header class="bg-white dark:bg-dt-dark | border-b border-border-color dark:border-dt-border-color | fixed w-full z-50 | select-none">
                @include('layouts.partials.app.navigation')
            </header>

            <!-- Page Content -->
            <main class="bg-gray-50 dark:bg-dt-darker | flex-grow | mt-16">
                @if ($breadcrumb)
                    <x-container>
                        <ul class="flex items-center | py-5 | text-xs md:tex-sm | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
                            @yield('breadcrumb')
                        </ul>
                    </x-container>
                @endif
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            @if (!$wfooter)
                <footer class="bg-gray-150 dark:bg-dt-darkest | dark:text-dt-text-light-color | border-t border-gray-200 dark:border-transparent | pb-3 md:py-6">
                    @include('layouts.partials.app.footer')
                </footer>
            @endif


            @livewire('livewire-ui-modal')
            @livewireScripts

            @include('cookieConsent::index')
            @include('layouts.partials.toastr')

        </div>

    </body>

</html>
