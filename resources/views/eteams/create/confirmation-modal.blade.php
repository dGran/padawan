<div class="dark:bg-dt-dark p-4 sm:p-6">
    <div class="sm:flex sm:items-start">

        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-base sm:text-lg leading-6 font-medium text-title-color dark:text-dt-title-color" id="modal-title">
                ¿Deseas crear el equipo?
            </h3>
            <div class="mt-2">
                <p class="text-xs sm:text-sm py-2">
                    Podrás agregar o modificar cualquier dato posteriormete desde el panel de administración del equipo.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="dark:bg-dt-dark border-t border-border-color dark:border-dt-border-color px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
    <x-button type="button" class="w-full inline-flex justify-center | sm:ml-3 sm:w-auto | text-sm sm:text-normal" wire:click="store">
        {{ __('Sí, crear equipo') }}
    </x-button>
    <x-button type="button" color="" class="w-full inline-flex justify-center | mt-3 sm:mt-0 | sm:ml-3 sm:w-auto | text-sm sm:text-normal" @click="open = false">
        {{ __('No, cancelar') }}
    </x-button>
</div>