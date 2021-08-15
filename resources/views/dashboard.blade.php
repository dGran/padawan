<x-app-layout>
    <x-slot name="header">
        <h2 class="font-fjalla text-2xl text-xl dark:text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="font-light">
                <h4 class="text-black dark:text-white text-2xl mb-4 -mx-2 tracking-wide">
                    <span class="text-red-base">#</span>
                    <span>Introduction</span>
                </h4>
                To give you a head start building your new Laravel application, we are happy to offer authentication and application starter kits. These kits automatically scaffold your application with the routes, controllers, and views you need to register and authenticate your application's users.
            </div>

            <div class="mt-6 p-6 text-sm rounded bg-dark-600 text-dark-light">
                <p class="font-light ...">The quick brown fox ...</p>
                <p class="font-normal ...">The quick brown fox ...</p>
                <p class="font-medium ...">The quick brown fox ...</p>
                <p class="font-semibold ...">The quick brown fox ...</p>
                <p class="font-bold ...">The quick brown fox ...</p>
                <p>
                    <i class="icon-logo"></i>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
