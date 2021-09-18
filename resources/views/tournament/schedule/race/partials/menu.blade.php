<div class="border-t border-b border-border-color dark:border-dt-border-color | px-4 pt-4 pb-2 md:pt-6 pb-3 | bg-edgray-200 dark:bg-dt-dark-accent">
    <div class="flex items-center justify-start sm:justify-center space-x-4 sm:space-x-6 lg:space-x-12 | overflow-x-auto | scrollbar-thin thinest scrollbar-thumb-sb-thumb-color scrollbar-track-sb-track-color hover:scrollbar-thumb-sb-thumb-color-hover dark:scrollbar-thumb-sb-thumb-dt-color dark:scrollbar-track-sb-track-dt-color dark:hover:scrollbar-thumb-sb-thumb-dt-color-hover scrollbar-thumb-rounded-full">
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-1 md:mb-2 | {{ $op == 'circuito' ? 'text-'.$color.'-600 dark:text-'.$color.'-400 | pointer-events-none' : 'text-edgray-700 dark:text-edgray-400 | hover:text-edgray-600 dark:hover:text-white | focus:text-edgray-600 dark:focus:text-white' }} focus:outline-none" wire:click="changeTab('circuito')">
            <i class="icon-circuit text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Circuito</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-2 md:mb-3 | {{ $op == 'pilotos' ? 'text-'.$color.'-600 dark:text-'.$color.'-400 | pointer-events-none' : 'text-edgray-700 dark:text-edgray-400 | hover:text-edgray-600 dark:hover:text-white | focus:text-edgray-600 dark:focus:text-white' }} focus:outline-none" wire:click="changeTab('pilotos')">
            <i class="icon-pilot text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Pilotos</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-2 md:mb-3 | {{ $op == 'calificacion' ? 'text-'.$color.'-600 dark:text-'.$color.'-400 | pointer-events-none' : 'text-edgray-700 dark:text-edgray-400 | hover:text-edgray-600 dark:hover:text-white | focus:text-edgray-600 dark:focus:text-white' }} focus:outline-none" wire:click="changeTab('calificacion')">
            <i class="icon-qualy text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Calificación</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-2 md:mb-3 | {{ $op == 'carrera' ? 'text-'.$color.'-600 dark:text-'.$color.'-400 | pointer-events-none' : 'text-edgray-700 dark:text-edgray-400 | hover:text-edgray-600 dark:hover:text-white | focus:text-edgray-600 dark:focus:text-white' }} focus:outline-none" wire:click="changeTab('carrera')">
            <i class="icon-race text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Carrera</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-2 md:mb-3 | {{ $op == 'carrera' ? 'text-'.$color.'-600 dark:text-'.$color.'-400 | pointer-events-none' : 'text-edgray-700 dark:text-edgray-400 | hover:text-edgray-600 dark:hover:text-white | focus:text-edgray-600 dark:focus:text-white' }} focus:outline-none" wire:click="changeTab('carrera')">
            <i class="icon-reclamation text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Reclamaciones</span>
        </button>
        <button class="flex flex-col items-center space-x-1 lg:space-x-1.5 mb-2 md:mb-3 | {{ $op == 'multimedia' ? 'text-'.$color.'-600 dark:text-'.$color.'-400 | pointer-events-none' : 'text-edgray-700 dark:text-edgray-400 | hover:text-edgray-600 dark:hover:text-white | focus:text-edgray-600 dark:focus:text-white' }} focus:outline-none" wire:click="changeTab('multimedia')">
            <i class="icon-multimedia text-3xl sm:text-4xl"></i>
            <span class="uppercase text-xxxs lg:text-xxs mt-1 lg:mt-1.5">Multimedia</span>
        </button>

    </div>
</div>