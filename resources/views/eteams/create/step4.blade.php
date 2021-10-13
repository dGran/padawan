<ul class="flex items-center flex-nowrap | space-x-4 | py-2 | overflow-x-auto | scrollbar-thin scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" wire:click="changeStep(2, false)">Paso 1</x-button-link>
    </li>
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step2_disabled }}" wire:click="changeStep(3, false)">Paso 2</x-button-link>
    </li>
    <li class="flex-shrink-0">
        <x-button-link class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide" disabled="{{ $step3_disabled }}" wire:click="changeStep(4, false)">Paso 3</x-button-link>
    </li>
    <li class="flex-shrink-0">
        <span class="text-base lg:text-lg | font-raleway font-extrabold | tracking-wide | px-2 py-1 | bg-edblue-500 | border border-edblue-500 rounded | text-white | focus:outline-none | select-none">Paso 4</span>
    </li>
</ul>

<h4 class="text-base lg:text-lg | font-raleway font-bold | tracking-wide | mt-4">
    Presentación del equipo
</h4>


<x-card class="my-1.5 p-4 md:p-6 | text-xs lg:text-sm">
    {{-- content --}}
</x-card>

<div class="mt-3 flex items-center justify-end">
    <x-button class="text-center text-normal lg:text-base" {{-- disabled="{{ $step3_disabled }}" --}} {{-- wire:click="changeStep(3, true)" --}}>
        {{ __('Crear equipo') }}
    </x-button>
</div>