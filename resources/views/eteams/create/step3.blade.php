<h4 class="text-lg lg:text-xl | font-raleway font-extrabold | tracking-wide | mb-1">
    <span class="text-edblue-500 dark:text-edblue-400">Paso 2.</span> Datos generales
</h4>

<x-card class="my-1.5 p-4 | text-xs lg:text-sm">
    {{-- <form wire:submit.prevent="store" method="POST" action="{{ route('register') }}" class="pt-6"> --}}
        @csrf

        <div>
            <x-label for="country_id" :value="__('* Juego')" />
            <x-select class="sm:mt-1 w-full" id="game_id" wire:model="game_id">
                <option hidden selected>Selecciona el juego</option>
                {{-- <option value="">N/D</option> --}}
                @foreach ($games as $game)
                    <option value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <x-label for="name" :value="__('* Nombre')" />
                <x-input id="name" wire:model="name" class="block sm:mt-1 w-full" type="text" placeholder="Nombre del equipo" />
            </div>

            <div>
                <x-label for="short_name" :value="__('* Nombre corto')" />
                <x-input id="short_name" wire:model="short_name" wire:keyup="transformShortName" maxlength="3" class="block sm:mt-1 w-full" type="text" placeholder="Nombre corto del equipo" />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <x-label for="country_id" :value="__('País')" />
                <x-select class="sm:mt-1 w-full" id="country_id">
                    <option value="">N/D</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div>
                <x-label for="location" :value="__('Sede')" />
                <x-input id="location" wire:model="location" class="block sm:mt-1 w-full" type="text" placeholder="Sede del equipo" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mt-4">
            <div>
                <x-label for="website" :value="__('website')" class="capitalize" />
                <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-website"></span>
                    <x-input wire:model="website" id="website" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Website del equipo" />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <x-label for="whatsapp" :value="__('whatsapp')" class="capitalize" />
                <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-whatsapp"></span>
                    <x-input wire:model="whatsapp" id="whatsapp" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Whatsapp del equipo" />
                </div>
            </div>

            <div>
                <x-label for="twitter" :value="__('twitter')" class="capitalize" />
                <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitter"></span>
                    <x-input wire:model="twitter" id="twitter" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Twitter del equipo" />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <x-label for="facebook" :value="__('facebook')" class="capitalize" />
                <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-facebook"></span>
                    <x-input wire:model="facebook" id="facebook" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Facebook del equipo" />
                </div>
            </div>

            <div>
                <x-label for="instagram" :value="__('instagram')" class="capitalize" />
                <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-instagram"></span>
                    <x-input wire:model="instagram" id="instagram" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Instagram del equipo" />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <x-label for="youtube" :value="__('youtube')" class="capitalize" />
                <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-youtube"></span>
                    <x-input wire:model="youtube" id="youtube" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Canal youtube del equipo" />
                </div>
            </div>

            <div>
                <x-label for="twitch" :value="__('twitch')" class="capitalize" />
                <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                    <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitch"></span>
                    <x-input wire:model="twitch" id="twitch" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Canal twitch del equipo" />
                </div>
            </div>
        </div>

        <div class="pt-8">
            <x-button class="w-full text-center text-normal lg:text-base" {{-- disabled="{{ $formDisabled }}" --}} wire:click="$set('paso', 1)">
                {{ __('Anterior') }}
            </x-button>
            <x-button class="w-full text-center text-normal lg:text-base" {{-- disabled="{{ $formDisabled }}" --}} wire:click="$set('paso', 3)">
                {{ __('Siguiente') }}
            </x-button>
        </div>
    {{-- </form> --}}
</x-card>