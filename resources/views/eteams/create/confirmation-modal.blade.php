<div class="relative | bg-white dark:bg-dt-dark p-4 sm:py-8">
    <div class="flex flex-col items-center">
    	<h4 class="text-normal md:text-base font-semibold">
    		Confirmación
    	</h4>
    	<p class="pt-3">
        	Como fundador del equipo, tendrás acceso al panel de administración del equipo donde podrás editar toda la información.
        	Se podrán editar todos los datos desde el panel de administración del equipo.
    	</p>

    <div class="mt-6 flex items-center justify-between space-x-4">
    	<x-button wire:click="$emit('closeModal')">
    		Cancelar
    	</x-button>
	    <x-button wire:click="store">
	        {{ __('Crear equipo') }}
	    </x-button>
    </div>

    </div>

    <i class="fas fa-times | absolute top-0 right-0 mt-2 mr-4 | text-lg | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>
</div>