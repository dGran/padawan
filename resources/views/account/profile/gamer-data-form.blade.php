<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <label for="xbox_id" class="capitalize text-sm font-medium">
                    {{ __('xbox ID') }}
                </label>
                <div class="relative {{ $xbox_id ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-xbox"></span>
                    <x-input wire:model="xbox_id" id="xbox_id" class="text-sm mt-1.5 pl-11 w-full" type="text" name="xbox_id" :value="old('xbox_id')" placeholder="Escribe tu Xbox ID" />
                </div>
            </div>
            <div>
                <label for="ps_id" class="capitalize text-sm font-medium">
                    {{ __('playstation ID') }}
                </label>
                <div class="relative {{ $ps_id ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-playstation"></span>
                    <x-input wire:model="ps_id" id="ps_id" class="text-sm mt-1.5 pl-11 w-full" type="text" name="ps_id" :value="old('ps_id')" placeholder="Escribe tu Playstation ID" />
                </div>
            </div>
            <div>
                <label for="steam_id" class="capitalize text-sm font-medium">
                    {{ __('steam ID') }}
                </label>
                <div class="relative {{ $steam_id ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-steam"></span>
                    <x-input wire:model="steam_id" id="steam_id" class="text-sm mt-1.5 pl-11 w-full" type="text" name="steam_id" :value="old('steam_id')" placeholder="Escribe tu Steam ID" />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end px-6 py-4 border-t border-border-color dark:border-dt-border-color">
            <x-action-message class="mr-3" on="update">
                {{ __('Guardado') }}
            </x-action-message>
            <x-action-message class="mr-3" on="noDirty">
                {{ __('No se han detectado cambios') }}
            </x-action-message>
            <x-action-message class="mr-3" on="updateError">
                {{ __('Fallo al guardar') }}
            </x-action-message>

            <button type="submit" wire:loading.attr="disabled"
                    class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out cursor-default">
                {{ __('Guardar cambios') }}
            </button>
        </div>
    </form>
</div>
