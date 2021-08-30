<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Title --}}
        <title>
            @isset($title) {{ $title }} | @endisset
            Admin {{ config('app.name', 'Laravel') }}
        </title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body class="bg-white dark:bg-dt-dark | font-sans | text-text-color dark:text-dt-text-color | text-sm md:text-normal | subpixel-antialiased | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">

        <nav class="hidden md:block | bg-gray-150 dark:bg-dt-dark | border-r border-gray-200 dark:border-dt-border-color | w-64 h-screen | fixed | overflow-y-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full | select-none">
            <div class="flex items-center px-3 py-2 h-12 border-b border-gray-200 dark:border-dt-border-color">
                <x-link href="{{ route('admin.dashboard') }}" class="flex items-center | focus:no-underline hover:no-underline">
                    <i class="icon-logo | text-3xl"></i>
                    <p class="ml-1.5">
                        <span class="text-base font-semibold tracking-tighter | text-title-color dark:text-dt-title-color">Admin</span>
                        <span class="text-base font-semibold tracking-tighter | text-title-color dark:text-dt-title-color">|</span>
                        <span class="text-xs font-normal tracking-tighter | text-title-color dark:text-dt-title-color | uppercase">{{ config('app.name') }}</span>
                    </p>
                </x-link>
            </div>
            <ul class="m-2">
                @include('layouts.partials.admin.left-sidebar')
            </ul>
        </nav>
        <div>
            <main class="bg-white dark:bg-dt-darker | ml-0 md:ml-64 | h-screen | overscroll-y-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
                <header class="fixed bg-gray-150 md:bg-white dark:bg-dt-dark md:dark:bg-dt-darker | border-b md:border-0 border-gray-200 dark:border-dt-border-color | w-full | select-none | h-12">
                    @include('layouts.partials.admin.header')
                </header>
                <div class="mt-12">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </body>
</html>
