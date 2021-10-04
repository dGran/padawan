<div>
	{{-- breadcrumb --}}
	@section('breadcrumb')
	    <li class="min-w-max">
	        <x-link class="" href="{{ route('dashboard') }}">Inicio</x-link><span class="px-1.5">/</span>
	    </li>
	    <li class="min-w-max">
	        <x-link class="" href="{{ route('eteams.index') }}">Equipos e-sports</x-link><span class="px-1.5">/</span>
	    </li>
	    <li class="min-w-max">
	        <span>Registro</span>
	    </li>
	@endsection

    <x-container>

        <x-card class="max-w-full md:max-w-2xl mx-auto my-4 lg:my-8 p-8 | text-xs lg:text-sm">
            <h4 class="text-center text-xl lg:text-2xl text-title-color dark:text-white | font-raleway font-extrabold | tracking-wide | mb-1">
                Registra tu equipo e-sport
            </h4>
{{--             <p class="text-center mb-2">
                {{ config('app.name') }}, competiciones online
            </p> --}}

            <form wire:submit.prevent="store" method="POST" action="{{ route('register') }}" class="pt-6">
                @csrf

                <div>
                    <x-label :value="__('Juego')" />
                    <x-dropdown-select align="left" width="full">
                        <x-slot name="trigger">
                            <button type="button" class="group | sm:mt-1 | appearance-none | w-full | flex items-center | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500">
                                <span class="fas fa-sort | text-lg | absolute top-0 right-0 pt-1.5 pr-3 | text-border-color dark:text-gray-700 | group-hover:text-gray-200 dark:group-hover:text-gray-600 | group-focus:text-gray-300 dark:group-focus:text-gray-500"></span>
                                @if ($game_selected)
                                    <img src="{{ $game_selected->getLogo() }}" alt="{{ $game_selected->name }}" class="flex-shrink-0 h-5 w-5 rounded-full | mr-3">
                                @endif
                                <span class="{{ $game_selected ?: 'text-gray-400 dark:text-gray-500' }}">{{ $game_selected ? $game_selected->name : 'Selecciona el juego' }}</span>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-span>
                                <x-input class="w-full my-1.5" wire:model="gameFilterName" wire:keyup="filterGames" wire:keydown.enter.prevent="changeGame({{ $games->count() > 0 ? $games->first()->id : 0 }})" placeholder="Buscar..." @keyup.enter="open = false"></x-input>
                            </x-dropdown-span>

                            <x-dropdown-divider></x-dropdown-divider>

                            <x-dropdown-link wire:click="changeGame('')" class="relative | flex space-x-3 | select-none | cursor-pointer" @click="open = false">
                                <span class="text-gray-400 dark:text-gray-500">Ninguno</span>
                                <span class="fas fa-check | absolute top-0 right-0 pt-3 pr-3 {{ !$game_selected ?: 'hidden' }}"></span>
                            </x-dropdown-link>

                            <x-dropdown-divider></x-dropdown-divider>

                            @foreach ($games->take(6) as $game)
                                <x-dropdown-link wire:click="changeGame({{ $game->id }})" class="relative | flex space-x-3 | select-none | cursor-pointer" @click="open = false">
                                    <img src="{{ $game->getLogo() }}" alt="" class="flex-shrink-0 h-5 w-5 rounded-full">
                                    <p>{{ $game->name }}</p>
                                    <span class="fas fa-check | absolute top-0 right-0 pt-3 pr-3 {{ $game_selected == $game ?: 'hidden' }}"></span>
                                </x-dropdown-link>
                            @endforeach

                            @if ($games->count() > 6)
                                <x-dropdown-span>
                                    <span class="text-gray-400 dark:text-gray-500">{{ $games->count() - 6 }} {{ $games->count() - 6 == 1 ? 'juego' : 'juegos' }} más...</span>
                                </x-dropdown-span>
                            @endif
                        </x-slot>
                    </x-dropdown-select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <x-label for="name" :value="__('Nombre')" />
                        <x-input id="name" wire:model="name" class="block sm:mt-1 w-full" type="text" placeholder="Nombre del equipo" />
                    </div>

                    <div>
                        <x-label for="short_name" :value="__('Nombre corto')" />
                        <x-input id="short_name" wire:model="short_name" wire:keyup="transformShortName" maxlength="3" class="block sm:mt-1 w-full" type="text" placeholder="Nombre corto del equipo" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <x-label :value="__('País')" />
                        <x-dropdown-select align="left" width="full">
                            <x-slot name="trigger">
                                <button type="button" class="group | sm:mt-1 | appearance-none | w-full | flex items-center | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500">
                                    <span class="fas fa-sort | text-lg | absolute top-0 right-0 pt-1.5 pr-3 | text-border-color dark:text-gray-700 | group-hover:text-gray-200 dark:group-hover:text-gray-600 | group-focus:text-gray-300 dark:group-focus:text-gray-500"></span>
                                    @if ($country_selected)
                                        <img src="{{ $country_selected->getFlag24() }}" alt="{{ $country_selected->name }}" class="flex-shrink-0 h-5 w-5 rounded-full | mr-3">
                                    @endif
                                    <span class="{{ $country_selected ?: 'text-gray-400 dark:text-gray-500' }}">{{ $country_selected ? $country_selected->name : 'Selecciona el país' }}</span>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-span>
                                    <x-input class="w-full my-1.5" wire:model="countryFilterName" wire:keyup="filterCountries" wire:keydown.enter.prevent="changeCountry({{ $countries->count() > 0 ? $countries->first()->id : 0 }})" placeholder="Buscar..." @keyup.enter="open = false"></x-input>
                                </x-dropdown-span>

                                <x-dropdown-divider></x-dropdown-divider>

                                <x-dropdown-item wire:click="changeCountry('')" class="relative | flex space-x-3 | select-none | cursor-pointer" @click="open = false">
                                    <span class="text-gray-400 dark:text-gray-500">Ninguno</span>
                                    <span class="fas fa-check | absolute top-0 right-0 pt-3 pr-3 {{ !$country_selected ?: 'hidden' }}"></span>
                                </x-dropdown-item>

                                <x-dropdown-divider></x-dropdown-divider>

                                @foreach ($countries->take(6) as $country)
                                    <x-dropdown-item wire:click="changeCountry({{ $country->id }})" class="relative | flex space-x-3 | select-none | cursor-pointer" @click="open = false">
                                        <img src="{{ $country->getFlag24() }}" alt="" class="flex-shrink-0 h-5 w-5 rounded-full">
                                        <p>{{ $country->name }}</p>
                                        <span class="fas fa-check | absolute top-0 right-0 pt-3 pr-3 {{ $country_selected == $country ?: 'hidden' }}"></span>
                                    </x-dropdown-item>
                                @endforeach

                                @if ($countries->count() > 6)
                                    <x-dropdown-span>
                                        <span class="text-gray-400 dark:text-gray-500">{{ $countries->count() - 6 }} {{ $countries->count() - 6 == 1 ? 'país' : 'paises' }} más...</span>
                                    </x-dropdown-span>
                                @endif
                            </x-slot>
                        </x-dropdown-select>
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
                            <x-input wire:model="whatsapp" id="whatsapp" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Escribe tu whatsapp" />
                        </div>
                    </div>

                    <div>
                        <x-label for="twitter" :value="__('twitter')" class="capitalize" />
                        <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitter"></span>
                            <x-input wire:model="twitter" id="twitter" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Escribe tu twitter" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <x-label for="facebook" :value="__('facebook')" class="capitalize" />
                        <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-facebook"></span>
                            <x-input wire:model="facebook" id="facebook" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Escribe tu facebook" />
                        </div>
                    </div>

                    <div>
                        <x-label for="instagram" :value="__('instagram')" class="capitalize" />
                        <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-instagram"></span>
                            <x-input wire:model="instagram" id="instagram" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Escribe tu instagram" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <x-label for="youtube" :value="__('youtube')" class="capitalize" />
                        <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-youtube"></span>
                            <x-input wire:model="youtube" id="youtube" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Escribe tu youtube" />
                        </div>
                    </div>

                    <div>
                        <x-label for="twitch" :value="__('twitch')" class="capitalize" />
                        <div class="relative | block sm:mt-1 w-full | text-text-light-color dark:text-dt-text-lighter-color focus-within:text-text-color dark:focus-within:text-dt-text-color">
                            <span class="absolute inset-y-0 left-0 | flex items-center | pl-4 | text-lg | icon-twitch"></span>
                            <x-input wire:model="twitch" id="twitch" class="block mt-0.5 pl-11 w-full" type="text" placeholder="Escribe tu twitch" />
                        </div>
                    </div>
                </div>

                <div class="pt-6 text-center">
                    <x-button class="w-full text-center text-normal lg:text-base">
                        {{ __('Registra tu equipo') }}
                    </x-button>

                    <!-- Session Status -->
                    <x-auth-session-status :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors :errors="$errors" />
                </div>
            </form>
        </x-card>

    </x-container>
</div>