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
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gray-100 dark:bg-dark-900 | font-sans | text-text-color dark:text-gray-300 | text-sm md:text-normal | subpixel-antialiased">

        <div class="flex flex-col h-screen">
            @include('layouts.partials.navigation')

            <!-- Page Heading -->
            @if ($blockHeader)
                <header class="bg-white dark:bg-dt-dark | border-b border-gray-100 dark:border-gray-700 | mt-16 fixed w-full z-40">
                    <x-container class="h-16">
                        {{ $header }}
                    </x-container>
                </header>
            @endif

            <!-- Page Content -->
            <main class="bg-gray-50 dark:bg-dt-darker | flex-grow {{ $blockHeader ? 'mt-32' : 'mt-16' }}">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <footer class="bg-gray-150 dark:bg-dt-darkest | border-t dark:border-transparent">
                @include('layouts.partials.footer')
            </footer>

            @include('cookieConsent::index')
        </div>

    </body>
</html>
