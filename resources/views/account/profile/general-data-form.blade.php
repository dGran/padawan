<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="px-6 mt-4">
            <img src="{{ $avatar ? $avatar->temporaryUrl() : $avatarPreview }}" alt="{{ $user->name }}" class="rounded-full w-32 h-32 mx-auto object-cover border border-border-color dark:border-dt-border-color">

            <label class="w-full | flex items-center justify-center space-x-3 | mt-1.5 px-4 py-2 | border border-border-color dark:border-dt-border-color | rounded-lg | uppercase | cursor-pointer | hover:bg-border-color dark:hover:bg-dt-border-color | hover:text-title-color dark:hover:text-dt-title-color">
                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                </svg>
                <span class="">Selecciona archivo...</span>
                <input type="file" class="hidden" accept=".jpeg, .png, .jpg, .gif, .svg" wire:model="avatar" wire:change="uploadAvatar"/>
            </label>
             @error('avatar') <p class="text-red-400 | mt-1 | text-xxs md:text-xs">{{ $message }}</p> @enderror
        </div>
        <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <label for="birthdate" class="capitalize text-sm font-medium">
                    {{ __('fecha nacimiento') }}
                </label>
                <x-input wire:model="birthdate" id="birthdate" class="text-sm mt-1.5 w-full" type="date" placeholder="Escribe tu fecha de nacimiento" />
            </div>
            <div>
                <label for="country_id" class="capitalize text-sm font-medium">
                    {{ __('nacionalidad') }}
                </label>
                <select wire:loading.attr="disabled" wire:model="countryId" id="country_id" class="text-sm mt-1.5 w-full | appearance-none | rounded | px-4 py-2 | bg-white dark:bg-dt-dark | border border-border-color dark:border-gray-700 | placeholder-gray-400 dark:placeholder-gray-500 | hover:border-gray-200 dark:hover:border-gray-600 | focus:outline-none focus:border-gray-300 dark:focus:border-gray-500"
                        placeholder="Selecciona tu nacionalidad" />
                    <option value="">N/D</option>
                    @foreach ($countries as $country)
                        @if ($countryId == $country->id)
                            <option selected value="{{ $country->id }}">
                                {{ $country->name }}
                            </option>
                        @else
                            <option value="{{ $country->id }}">
                                {{ $country->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="location" class="capitalize text-sm font-medium">
                    {{ __('Lugar de residencia') }}
                </label>
                <x-input wire:model="location" id="location" class="text-sm mt-1.5 w-full" type="text" placeholder="Escribe tu lugar de residencia" />
            </div>
        </div>

        <div class="px-6 pb-4">
            <div class="form-check form-switch flex items-center">
                <input
                    class="form-check-input appearance-none -ml-8 w-10 rounded-full h-5 bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none shadow-sm"
                    type="checkbox"
                    role="switch"
                    id="notifications"
                    wire:model="notifications"
                >
                <label class="form-check-label ml-1.5 text-sm font-medium" for="notifications">
                    Recibir notificaciones por e-mail
                </label>
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