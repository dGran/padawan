<h4 class="text-lg lg:text-xl | font-raleway font-extrabold | tracking-wide | mb-1">
    <span class="text-edblue-500 dark:text-edblue-400">Paso 2.</span> Datos generales
</h4>

<x-card class="my-1.5 p-4 | text-xs lg:text-sm">

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

    <div class="mt-8 pt-4 flex items-center justify-between | border-t border-border-color dark:border-dt-border-color">
        <x-button class="text-center text-normal lg:text-base" {{-- disabled="{{ $formDisabled }}" --}} wire:click="changeStep(2, false)">
            {{ __('Paso 1') }}
        </x-button>
        <x-button class="text-center text-normal lg:text-base" {{-- disabled="{{ $formDisabled }}" --}} wire:click="changeStep(2, true)">
            {{ __('Paso 3') }}
        </x-button>
    </div>
</x-card>