<h4 class="block | pb-3 | font-semibold | text-title-color dark:text-dt-title-color">
    Información del perfil
</h4>
<form wire:submit.prevent="updateGeneralData">
    @csrf
    <x-card class="p-5 md:p-7 flex flex-col space-y-4 md:space-y-6">
{{--         <div>
            <img src="{{ $user->profile->getAvatar() }}" alt="">
            <x-label for="name" :value="__('foto')" class="capitalize" />
            <x-input wire:model="name" id="name" class="block mt-0.5 w-full lg:w-3/6" type="text" name="name" :value="old('name')" placeholder="Escribe tu nombre" required/>
        </div> --}}
        <div>
            <x-label for="name" :value="__('nombre')" class="capitalize" />
            <x-input wire:model="name" id="name" class="block mt-0.5 w-full lg:w-3/6" type="text" name="name" :value="old('name')" placeholder="Escribe tu nombre" required/>
        </div>
        <div>
            <x-label for="email" :value="__('correo electrónico')" class="capitalize" />
            <x-input wire:model="email" id="email" class="block mt-0.5 w-full lg:w-3/6" type="text" name="email" :value="old('email')" placeholder="Escribe tu correo electrónico" />
        </div>
        <div>
            <x-label for="birthdate" :value="__('fecha nacimiento')" class="capitalize" />
            <x-input wire:model="birthdate" id="birthdate" class="block mt-0.5 w-full lg:w-3/6" type="date" name="birthdate" :value="old('birthdate')" placeholder="Escribe tu fecha de nacimiento" />
        </div>
        <div>
            <x-label for="country_id" :value="__('Nacionalidad')" class="capitalize" />
            <select wire:model="country_id" id="country_id" class="block mt-0.5 w-full lg:w-3/6 | appearance-none | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500" name="country_id" :value="old('country_id')" placeholder="Selecciona tu nacionalidad" />
                <option value="">N/D</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <x-label for="location" :value="__('Lugar residencia')" class="capitalize" />
            <x-input wire:model="location" id="location" class="block mt-0.5 w-full lg:w-3/6" type="text" name="location" :value="old('location')" placeholder="Escribe tu lugar de residencia" />
        </div>

        <div class="flex items-center justify-end mt-2 pt-4 md:pt-6 border-t border-border-color dark:border-dt-border-color | px-5 md:px-7 -mx-5 md:-mx-7">
            <x-action-message class="mr-3" on="updateGeneralData">
                {{ __('Guardado.') }}
            </x-action-message>
            <x-action-message class="mr-3" on="noDirtyGeneralData">
                {{ __('No se han detectado cambios.') }}
            </x-action-message>
            <x-action-message class="mr-3" on="updateErrorGeneralData">
                {{ __('Fallo al guardar.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" wire:target="updateGeneralData" class="uppercase text-xs font-miriam">
                {{ __('Guardar') }}
            </x-button>
        </div>
    </x-card>
</form>