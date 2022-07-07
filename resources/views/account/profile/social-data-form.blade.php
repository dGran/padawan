<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <x-label for="whatsapp" :value="__('whatsapp')" class="capitalize" />
                <div class="relative {{ $whatsapp ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-whatsapp"></span>
                    <x-input wire:model="whatsapp" id="whatsapp" class="text-sm mt-1.5 pl-11 w-full" type="text" name="whatsapp" :value="old('whatsapp')" placeholder="Escribe tu whatsapp" />
                </div>
            </div>
            <div>
                <x-label for="facebook" :value="__('facebook')" class="capitalize" />
                <div class="relative {{ $facebook ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-facebook"></span>
                    <x-input wire:model="facebook" id="facebook" class="text-sm mt-1.5 pl-11 w-full" type="text" name="facebook" :value="old('facebook')" placeholder="Escribe tu facebook" />
                </div>
            </div>
            <div>
                <x-label for="twitter" :value="__('twitter')" class="capitalize" />
                <div class="relative {{ $twitter ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitter"></span>
                    <x-input wire:model="twitter" id="twitter" class="text-sm mt-1.5 pl-11 w-full" type="text" name="twitter" :value="old('twitter')" placeholder="Escribe tu twitter" />
                </div>
            </div>
            <div>
                <x-label for="instagram" :value="__('instagram')" class="capitalize" />
                <div class="relative {{ $instagram ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-instagram"></span>
                    <x-input wire:model="instagram" id="instagram" class="text-sm mt-1.5 pl-11 w-full" type="text" name="instagram" :value="old('instagram')" placeholder="Escribe tu instagram" />
                </div>
            </div>
            <div>
                <x-label for="twitch" :value="__('twitch')" class="capitalize" />
                <div class="relative {{ $twitch ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitch"></span>
                    <x-input wire:model="twitch" id="twitch" class="text-sm mt-1.5 pl-11 w-full" type="text" name="twitch" :value="old('twitch')" placeholder="Escribe tu twitch" />
                </div>
            </div>
            <div>
                <x-label for="discord" :value="__('discord')" class="capitalize" />
                <div class="relative {{ $discord ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-discord"></span>
                    <x-input wire:model="discord" id="discord" class="text-sm mt-1.5 pl-11 w-full" type="text" name="discord" :value="old('discord')" placeholder="Escribe tu discord" />
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

            <button type="submit" wire:loading.attr="disabled" wire:target="updateGeneralData"
                    class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out cursor-default">
                {{ __('Guardar cambios') }}
            </button>
        </div>
    </form>
</div>
