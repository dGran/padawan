<form wire:submit.prevent="updateSocialData">
    @csrf
    <div>
        <x-label for="whatsapp" :value="__('whatsapp')" class="capitalize" />
        <div class="relative {{ $whatsapp ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-whatsapp"></span>
            <x-input wire:model="whatsapp" id="whatsapp" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="whatsapp" :value="old('whatsapp')" placeholder="Escribe tu whatsapp" />
        </div>
    </div>
    <div>
        <x-label for="facebook" :value="__('facebook')" class="capitalize" />
        <div class="relative {{ $facebook ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-facebook"></span>
            <x-input wire:model="facebook" id="facebook" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="facebook" :value="old('facebook')" placeholder="Escribe tu facebook" />
        </div>
    </div>
    <div>
        <x-label for="twitter" :value="__('twitter')" class="capitalize" />
        <div class="relative {{ $twitter ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitter"></span>
            <x-input wire:model="twitter" id="twitter" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="twitter" :value="old('twitter')" placeholder="Escribe tu twitter" />
        </div>
    </div>
    <div>
        <x-label for="instagram" :value="__('instagram')" class="capitalize" />
        <div class="relative {{ $instagram ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-instagram"></span>
            <x-input wire:model="instagram" id="instagram" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="instagram" :value="old('instagram')" placeholder="Escribe tu instagram" />
        </div>
    </div>
    <div>
        <x-label for="twitch" :value="__('twitch')" class="capitalize" />
        <div class="relative {{ $twitch ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitch"></span>
            <x-input wire:model="twitch" id="twitch" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="twitch" :value="old('twitch')" placeholder="Escribe tu twitch" />
        </div>
    </div>
    <div>
        <x-label for="discord" :value="__('discord')" class="capitalize" />
        <div class="relative {{ $discord ? 'text-text-color dark:text-dt-text-color' : 'text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color' }}">
            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-discord"></span>
            <x-input wire:model="discord" id="discord" class="block mt-0.5 pl-11 w-full lg:w-3/6" type="text" name="discord" :value="old('discord')" placeholder="Escribe tu discord" />
        </div>
    </div>
    <div class="flex items-center justify-end mt-2 pt-4 md:pt-6 border-t border-border-color dark:border-dt-border-color | px-5 md:px-7 -mx-5 md:-mx-7">
        <x-action-message class="mr-3" on="updateSocialData">
            {{ __('Guardado.') }}
        </x-action-message>
        <x-action-message class="mr-3" on="noDirtySocialData">
            {{ __('No se han detectado cambios.') }}
        </x-action-message>
        <x-action-message class="mr-3" on="updateErrorSocialData">
            {{ __('Fallo al guardar.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="updateSocialData" class="uppercase text-xs font-miriam">
            {{ __('Guardar') }}
        </x-button>
    </div>
</form>
