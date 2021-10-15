<ul class="flex items-center flex-nowrap | space-x-4 | py-2 | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" wire:click="changeStep(2, false)">Paso 1</x-button-link>
    </li>
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step2_disabled }}" wire:click="changeStep(3, false)">Paso 2</x-button-link>
    </li>
    <li class="flex-shrink-0">
        <span class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide | px-2 py-1 | bg-edblue-500 | border border-edblue-500 rounded | text-white | focus:outline-none | select-none">Paso 3</span>
    </li>
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step4_disabled }}" wire:click="changeStep(3, true)">Paso 4</x-button-link>
    </li>
</ul>

<h4 class="text-base lg:text-lg | font-raleway font-bold | tracking-wide | mt-4">
    Redes sociales
</h4>

<x-card class="my-1.5 p-4 md:p-6 | text-xs lg:text-sm">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <x-label for="whatsapp" :value="__('whatsapp')" class="capitalize" />
            <div class="relative | block mt-1.5 w-full">
                <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-whatsapp | text-text-light-color dark:text-dt-text-lighter-color"></span>
                <x-input wire:model="whatsapp" id="whatsapp" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Whatsapp del equipo" />
            </div>
        </div>

        <div>
            <x-label for="twitter" :value="__('twitter')" class="capitalize" />
            <div class="relative | block mt-1.5 w-full">
                <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitter | text-text-light-color dark:text-dt-text-lighter-color"></span>
                <x-input wire:model="twitter" id="twitter" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Twitter del equipo" />
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
        <div>
            <x-label for="facebook" :value="__('facebook')" class="capitalize" />
            <div class="relative | block mt-1.5 w-full">
                <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-facebook | text-text-light-color dark:text-dt-text-lighter-color"></span>
                <x-input wire:model="facebook" id="facebook" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Facebook del equipo" />
            </div>
        </div>

        <div>
            <x-label for="instagram" :value="__('instagram')" class="capitalize" />
            <div class="relative | block mt-1.5 w-full">
                <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-instagram | text-text-light-color dark:text-dt-text-lighter-color"></span>
                <x-input wire:model="instagram" id="instagram" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Instagram del equipo" />
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
        <div>
            <x-label for="youtube" :value="__('youtube')" class="capitalize" />
            <div class="relative | block mt-1.5 w-full">
                <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-youtube | text-text-light-color dark:text-dt-text-lighter-color"></span>
                <x-input wire:model="youtube" id="youtube" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Canal youtube del equipo" />
            </div>
        </div>

        <div>
            <x-label for="twitch" :value="__('twitch')" class="capitalize" />
            <div class="relative | block mt-1.5 w-full">
                <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitch | text-text-light-color dark:text-dt-text-lighter-color"></span>
                <x-input wire:model="twitch" id="twitch" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Canal twitch del equipo" />
            </div>
        </div>
    </div>
</x-card>

<div class="mt-3 flex items-center justify-end">
    <x-button class="text-center text-normal lg:text-base" disabled="{{ $step3_disabled }}" wire:click="changeStep(3, true)">
        {{ __('Continuar') }}
    </x-button>
</div>