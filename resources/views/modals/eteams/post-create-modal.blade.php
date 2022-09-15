<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>

    {{--header--}}
    <div class="p-4 border-b border-border-color dark:border-edgray-700 | font-semibold text-title-color dark:text-dt-title-color">
        Nueva noticia
    </div>

    <form wire:submit.prevent="store">
        @csrf
        {{--content--}}
        <div class="p-4 flex flex-col space-y-4">
            <div>
                <label for="title" class="capitalize text-sm font-medium">
                    {{ __('Título') }}
                </label>
                <x-input wire:model="title" id="title" class="text-sm mt-1.5 w-full" type="text" placeholder="Escribe el título de la noticia" autofocus></x-input>
                @error('title')<span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="content" class="capitalize text-sm font-medium">
                    {{ __('Contenido') }}
                </label>
                <x-textarea id="content" rows="10" class="text-sm mt-1.5 w-full" wire:model="content" placeholder="Escribe el contenido de la noticia"></x-textarea>
                @error('content')<span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="visibility" class="capitalize text-sm font-medium">
                    {{ __('Visibilidad') }}
                </label>
                <x-select wire:model="public" class="text-sm mt-1.5 w-full">
                    <option selected value="1">{{ __('Pública') }}</option>
                    <option value="0">{{ __('Privada') }}</option>
                </x-select>
                @error('public')<span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        {{--footer--}}
        <div class="p-4 border-t border-border-color dark:border-edgray-700 | flex items-center justify-end">
            <button type="button" class="inline-block px-4 py-1.5 text-xxs leading-tight rounded hover:text-title-color dark:hover:text-dt-title-color focus:text-title-color dark:focus:text-dt-title-color focus:outline-none transition duration-150 ease-in-out" wire:click="$emit('closeModal')">
                {{ __('Cancelar') }}
            </button>
            <x-button type="submit" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out">
                {{ __('Crear noticia') }}
            </x-button>
        </div>
    </form>
</div>

