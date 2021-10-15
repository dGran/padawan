<div class="relative | bg-white dark:bg-dt-dark p-4 sm:py-8">
    <div class="flex flex-col items-center">
        <p class="pt-4 sm:pt-0 text-title-color dark:text-dt-title-color">
            ¿Deseas crear el equipo?
        </p>
    	<p class="py-4 | text-center | text-xxs md:text-xs | text-text-light-color dark:text-dt-text-light-color">
        	Podrás agregar o modificar cualquier dato posteriormete desde el panel de administración del equipo.
    	</p>

    <div class="mt-2.5 | w-full | flex items-center justify-between space-x-4">
    	<button class="px-4 py-2 | bg-white dark:bg-dt-dark | rounded | font-semibold text-sm text-title-color dark:text-dt-title-color | hover:bg-border-color dark:hover:bg-dt-border-color | focus:outline-none focus:bg-border-color dark:focus:bg-dt-border-color | transition ease-in-out duration-75 | select-none | cursor-pointer" wire:click="$emit('closeModal')">
    		No, cancelar
    	</button>
	    <x-button wire:click="store">
	        {{ __('Sí, crear equipo') }}
	    </x-button>
    </div>

    </div>

    <i class="fas fa-times | absolute top-0 right-0 mt-2 mr-4 | text-lg | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>
</div>