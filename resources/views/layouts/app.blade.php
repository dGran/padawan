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

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-white dark:bg-dark-700 | font-sans text-gray-900 dark:text-dark-normal text-sm md:text-md | antialiased">

        <div class="flex flex-col h-screen">
            @include('layouts.partials.navigation')

            <!-- Page Heading -->
            @if ($blockHeader)
                <header class="bg-gray-50 dark:bg-dark-800 | shadow | mt-16 fixed w-full z-40">
                    <x-container class="py-4 h-16">
                        {{ $header }}
                    </x-container>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow {{ $blockHeader ? 'mt-32' : 'mt-16' }}">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <footer class="bg-gray-50 dark:bg-dark-900 | border-t dark:border-transparent">
                @include('layouts.partials.footer')
            </footer>

            @include('cookieConsent::index')
        </div>

    </body>
</html>
