<form wire:submit.prevent="updateGamerData">
    @csrf
    <div>
        <x-label for="xbox_id" :value="__('xbox ID')" class="capitalize" />
        <div class="relative {{ $xbox_id ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-xbox"></span>
            <x-input wire:model="xbox_id" id="xbox_id" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="xbox_id" :value="old('xbox_id')" placeholder="Escribe tu Xbox ID" />
        </div>
    </div>
    <div>
        <x-label for="ps_id" :value="__('playstation ID')" class="capitalize" />
        <div class="relative {{ $ps_id ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-playstation"></span>
            <x-input wire:model="ps_id" id="ps_id" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="ps_id" :value="old('ps_id')" placeholder="Escribe tu Playstation ID" />
        </div>
    </div>
    <div>
        <x-label for="steam_id" :value="__('steam ID')" class="capitalize" />
        <div class="relative {{ $steam_id ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-steam"></span>
            <x-input wire:model="steam_id" id="steam_id" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="steam_id" :value="old('steam_id')" placeholder="Escribe tu Steam ID" />
        </div>
    </div>
  <div>
        <x-label for="origin_id" :value="__('origin ID')" class="capitalize" />
        <div class="relative {{ $origin_id ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-origin"></span>
            <x-input wire:model="origin_id" id="origin_id" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="origin_id" :value="old('origin_id')" placeholder="Escribe tu Origin ID" />
        </div>
    </div>

    <div class="flex items-center justify-end mt-2 pt-4 md:pt-6 border-t border-border-color dark:border-dt-border-color | px-5 md:px-7 -mx-5 md:-mx-7">
        <x-action-message class="mr-3" on="updateGamerData">
            {{ __('Guardado.') }}
        </x-action-message>
        <x-action-message class="mr-3" on="noDirtyGamerData">
            {{ __('No se han detectado cambios.') }}
        </x-action-message>
        <x-action-message class="mr-3" on="updateErrorGamerData">
            {{ __('Fallo al guardar.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="updateGamerData" class="uppercase text-xs font-miriam">
            {{ __('Guardar') }}
        </x-button>
    </div>
</form>
