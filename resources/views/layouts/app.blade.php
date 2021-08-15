<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-white dark:bg-dark-700 | font-poppins text-gray-900 dark:text-dark-normal | antialiased">

        <div class="flex flex-col h-screen">
            {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            <header class="bg-gray-100 dark:bg-dark-800">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-grow">
                <button class="cursor-pointer p-3">
                    <i id="light-toggle" class="icon-sun"></i>
                    <i id="dark-toggle" class="icon-moon"></i>
                    <i id="device-toggle" class="icon-dark-light"></i>
                </button>
                {{ $slot }}
            </main>

            <footer class="bg-gray-50 dark:bg-dark-900 | border-t border-gray-100 dark:border-transparent">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-sm text-gray-600 dark:text-dark-normal">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis asperiores deserunt explicabo illum id dolorem provident inventore. Optio sapiente, doloribus aspernatur, in minima cumque eum ipsum non quam consectetur exercitationem?
                    </p>
                </div>
            </footer>
        </div>

        <script>
            const dark_toogle = document.querySelector('#dark-toggle');
            const light_toogle = document.querySelector('#light-toggle');
            const device_toogle = document.querySelector('#device-toggle');
            const html = document.querySelector('html');

            function setDarkMode()
            {
                localStorage.theme = 'dark';
                setTheme();
            }
            function setLightMode()
            {
                localStorage.theme = 'light';
                setTheme();
            }
            function setDeviceMode()
            {
                localStorage.removeItem('theme');
                setTheme();
            }
            function setTheme()
            {
                if (localStorage.theme === 'dark') {
                    html.classList.add('dark');
                } else if (localStorage.theme === 'light') {
                    html.classList.remove('dark');
                } else {
                    localStorage.removeItem('theme');
                }
            }

            dark_toogle.addEventListener("click", setDarkMode);
            light_toogle.addEventListener("click", setLightMode);
            device_toogle.addEventListener("click", setDeviceMode);

            // dark_toogle.addEventListener("click", setLightMode());

            setTheme();



            // localStorage.removeItem('theme')
        </script>
    </body>
</html>
