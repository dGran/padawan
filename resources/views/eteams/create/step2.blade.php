<ul class="flex items-center flex-nowrap | space-x-4 | py-2 | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" wire:click="changeStep(2, false)">Paso 1</x-button-link>
    </li>
    <li class="flex-shrink-0">
        <span class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide | px-2 py-1 | bg-edblue-500 | border border-edblue-500 rounded | text-white | focus:outline-none | select-none">Paso 2</span>
    </li>
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step3_disabled }}" wire:click="changeStep(2, true)">Paso 3</x-button-link>
    </li>
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step4_disabled }}" wire:click="changeStep(3, true)">Paso 4</x-button-link>
    </li>
</ul>

<h4 class="text-base lg:text-lg | font-raleway font-bold | tracking-wide | mt-4">
    Datos generales
</h4>

<x-card class="my-1.5 p-4 md:p-6 | text-xs lg:text-sm">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <x-label for="name" :value="__('* Nombre')" />
            <x-input id="name" wire:model="name" wire:keyup="checkName" class="block sm:mt-1 w-full" type="text" placeholder="Nombre del equipo" autofocus/>
            @if ($name && !$name_available)
                <p class="text-red-400 | mt-1 | text-xxs md:text-xs">El nombre ya está registrado</p>
            @endif
        </div>

        <div>
            <x-label for="short_name" :value="__('* Nombre corto')" />
            <x-input id="short_name" wire:model="short_name" wire:keyup="checkShortName" wire:change="transformShortName" maxlength="3" class="block sm:mt-1 w-full" type="text" placeholder="Nombre corto del equipo" />
            @if ($short_name && !$short_name_available)
                <p class="text-red-400 | mt-1 | text-xxs md:text-xs">El nombre corto ya está registrado</p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
        <div>
            <x-label for="country_id" :value="__('País')" />
            <x-select class="sm:mt-1 w-full" id="country_id">
                <option value="">N/D</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </x-select>
        </div>

        <div>
            <x-label for="location" :value="__('Sede')" />
            <x-input id="location" wire:model="location" class="block sm:mt-1 w-full" type="text" placeholder="Sede del equipo" />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-4">
        <div>
            <x-label for="website" :value="__('website')" class="capitalize" />
            <div class="relative | block sm:mt-1 w-full">
                <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-website | text-text-light-color dark:text-dt-text-lighter-color"></span>
                <x-input wire:model="website" id="website" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Website del equipo" />
            </div>
        </div>
    </div>
</x-card>

<div class="mt-3 flex items-start justify-between">
    <div class="text-xxs md:text-xs">
        * Campos obligatorios
    </div>
    <x-button class="text-center text-normal lg:text-base" disabled="{{ $step3_disabled }}" wire:click="changeStep(2, true)">
        {{ __('Continuar') }}
    </x-button>
</div>