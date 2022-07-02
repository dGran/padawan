<form wire:submit.prevent="updateGeneralData">
    @csrf
    {{--         <div>--}}
    {{--            <img src="{{ $user->profile->getAvatar() }}" alt="">--}}
    {{--            <x-label for="name" :value="__('foto')" class="capitalize text-sm" />--}}
    {{--            <x-input wire:model="name" id="name" class="text-sm mt-0.5 w-full" type="text" name="name" :value="$name" placeholder="Escribe tu nombre" required/>--}}
    {{--        </div> --}}

    <div class="px-6 py-4 flex flex-col space-y-4">
        <div>
            <x-label for="name" :value="__('nombre')" class="capitalize text-sm" />
            <x-input wire:model="name" id="name" class="text-sm mt-0.5 w-full" type="text" name="name" :value="$name" placeholder="Escribe tu nombre" required/>
        </div>
        <div>
            <x-label for="email" :value="__('correo electrónico')" class="capitalize text-sm" />
            <x-input wire:model="email" id="email" class="text-sm mt-0.5 w-full" type="text" name="email" :value="$email" placeholder="Escribe tu correo electrónico" />
        </div>
        <div>
            <x-label for="birthdate" :value="__('fecha nacimiento')" class="capitalize text-sm" />
            <x-input wire:model="birthdate" id="birthdate" class="text-sm mt-0.5 w-full" type="date" name="birthdate" :value="$birthdate" placeholder="Escribe tu fecha de nacimiento" />
        </div>
        <div>
            <x-label for="country_id" :value="__('Nacionalidad')" class="capitalize text-sm" />
            <select wire:model="country_id" id="country_id" class="text-sm mt-0.5 w-full | appearance-none | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500" name="country_id" :value="$country_id" placeholder="Selecciona tu nacionalidad" />
                <option value="">N/D</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <x-label for="location" :value="__('Lugar residencia')" class="capitalize text-sm" />
            <x-input wire:model="location" id="location" class="text-sm mt-0.5 w-full" type="text" name="location" :value="$location" placeholder="Escribe tu lugar de residencia" />
        </div>
    </div>

    <div class="flex items-center justify-end px-6 py-4 border-t border-border-color dark:border-dt-border-color">
        <x-action-message class="mr-3" on="updateGeneralData">
            {{ __('Guardado.') }}
        </x-action-message>
        <x-action-message class="mr-3" on="noDirtyGeneralData">
            {{ __('No se han detectado cambios.') }}
        </x-action-message>
        <x-action-message class="mr-3" on="updateErrorGeneralData">
            {{ __('Fallo al guardar.') }}
        </x-action-message>

        <button type="button" wire:loading.attr="disabled" wire:target="updateGeneralData" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
            {{ __('Guardar cambios') }}
        </button>
    </div>

</form>
