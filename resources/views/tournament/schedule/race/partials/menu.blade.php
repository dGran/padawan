<div class="flex items-center px-4 justify-center gap-4 sm:gap-6 lg:gap-12 | border-t border-edgray-800 p-6 bg-gray-100 dark:bg-dt-darker | overflow-x-auto">
    <a class="flex flex-col items-center gap-1 lg:gap-1.5 | {{ $op == 'circuit' ? 'text-edblue-800 dark:text-edblue-400 | pointer-events-none' : 'text-edblue-800 dark:text-edblue-100 | cursor-pointer' }}" wire:click="changeTab('circuit')">
        <i class="icon-circuit text-3xl sm:text-4xl"></i>
        <span class="uppercase text-xxxs lg:text-xxs">Circuito</span>
    </a>
    <a class="flex flex-col items-center gap-1 lg:gap-1.5 | {{ $op == 'pilots' ? 'text-edblue-800 dark:text-edblue-400 | pointer-events-none' : 'text-edblue-800 dark:text-edblue-100 | cursor-pointer' }}" wire:click="changeTab('pilots')">
        <i class="icon-pilot text-3xl sm:text-4xl"></i>
        <span class="uppercase text-xxxs lg:text-xxs">Pilotos</span>
    </a>
    <a class="flex flex-col items-center gap-1 lg:gap-1.5 | {{ $op == 'qualy' ? 'text-edblue-800 dark:text-edblue-400 | pointer-events-none' : 'text-edblue-800 dark:text-edblue-100 | cursor-pointer' }}" wire:click="changeTab('qualy')">
        <i class="icon-qualy text-3xl sm:text-4xl"></i>
        <span class="uppercase text-xxxs lg:text-xxs">Clasificación</span>
    </a>
    <a class="flex flex-col items-center gap-1 lg:gap-1.5 | {{ $op == 'race' ? 'text-edblue-800 dark:text-edblue-400 | pointer-events-none' : 'text-edblue-800 dark:text-edblue-100 | cursor-pointer' }}" wire:click="changeTab('race')">
        <i class="icon-race text-3xl sm:text-4xl"></i>
        <span class="uppercase text-xxxs lg:text-xxs">Carrera</span>
    </a>
    <a class="flex flex-col items-center gap-1 lg:gap-1.5 | {{ $op == 'multimedia' ? 'text-edblue-800 dark:text-edblue-400 | pointer-events-none' : 'text-edblue-800 dark:text-edblue-100 | cursor-pointer' }} opacity-30" wire:click="changeTab('multimedia')">
        <i class="icon-multimedia text-3xl sm:text-4xl"></i>
        <span class="uppercase text-xxxs lg:text-xxs">Multimedia</span>
    </a>
</div>