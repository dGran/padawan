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
    <div>
        <x-label for="presentation_video" :value="__('Video presentación (video ID youtube)')"/>
        <p class="pb-1 | text-text-light-color dark:text-dt-text-light-color | text-xxxs md:text-xxs">Ejemplo. https://www.youtube.com/watch?v=<span class="bg-dt-border-color dark:bg-border-color | text-dt-title-color dark:text-title-color | px-1.5 | rounded | text-xs md:text-sm">xxxxxxx</span></p>
        <x-input id="presentation_video" wire:model="presentation_video" class="block sm:mt-1 w-full" type="text" placeholder="Video presentación del equipo"/>
    </div>

    <div class="mt-4">
        <x-label for="presentation" :value="__('presentación')" class="capitalize" />
        <span class="pb-1 | text-text-light-color dark:text-dt-text-light-color | text-xxs md:text-xs">Escribe un texto de presentación de tu equipo. Historia, normas, a qué se dedica...</span>
        <div class="block sm:mt-1 w-full">
            <x-textarea wire:model="presentation" id="presentation" class="mt-0.5 w-full h-48 | resize-y" placeholder="Texto de presentación del equipo"></x-textarea>
        </div>
    </div>

</x-card>

<div class="mt-3 flex items-center justify-end">
    <x-button class="text-center text-normal lg:text-base" wire:click="store">
        {{ __('Crear equipo') }}
    </x-button>
</div>