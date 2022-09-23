<div class="relative | bg-white dark:bg-dt-dark focus:outline-none">
    {{--icon-close--}}
    <i class="fa-solid fa-xmark | absolute top-0 right-0 m-3 | text-base | opacity-70 hover:opacity-100 | cursor-pointer" wire:click="$emit('closeModal')"></i>

    {{--header--}}
    <div class="p-4 border-b border-border-color dark:border-edgray-700 | font-semibold text-title-color dark:text-dt-title-color">
        Nueva invitación
    </div>

    {{--content--}}

    <div class="flex flex-col space-y-4">
        <label for="availableUsers" class="text-xs">
            <p class="px-4">
                Usuarios sin equipo
            </p>
        </label>
        <table class="min-w-full">
            <tbody>
                @foreach($availableUsers as $user)
                    <tr class="border-b border-border-color dark:border-edgray-700">
                        <td class="w-10 text-sm font-light px-4 py-2.5 whitespace-nowrap">
                            fecha registro
                        </td>
                        <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                            {{ $user->name }}
                        </td>
                        <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                            <button type="submit" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    wire:click="sendInvitation({{ $user }})">
                                {{ __('Enviar invitación') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex items-center justify-end | text-xxs md:text-xs | border-t border-border-color dark:border-edgray-700">
            <p class="text-text-light-color | flex items-center space-x-1">
                <span class="font-medium">{{ $availableUsers->firstItem() }}</span>
                <span>/</span>
                <span class="font-medium">{{ $availableUsers->lastItem() }}</span>
                <span>de</span>
                <span class="font-medium">{{ $availableUsers->total() }}</span>
                <span>Usuarios</span>
            </p>
            <div class="pl-3 | flex items-center space-x-0">
                <button wire:click="previousPage({{ $availableUsers->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-l-md | focus:outline-none">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <select class="appearance-none font-bold | h-9 w-10 px-3 text-center | bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | border-t border-b border-gray-200 dark:border-gray-700 | focus:outline-none | cursor-pointer" wire:model="page" wire:change="setCurrentPage">
                    @for ($i = 1; $i < $availableUsers->lastPage()+1 ; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <button wire:click="nextPage({{ $availableUsers->lastPage() }})" class="bg-white dark:bg-dt-dark hover:bg-gray-100 dark:hover:bg-dt-darker focus:bg-gray-100 dark:focus:bg-dt-darker | h-9 w-10 | border border-gray-200 dark:border-gray-700 | rounded-r-md | focus:outline-none">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    {{--footer--}}
    <div class="p-4 border-t border-border-color dark:border-edgray-700 | flex items-center justify-end">
        <button type="button" class="inline-block px-4 py-1.5 text-xxs leading-tight rounded hover:text-title-color dark:hover:text-dt-title-color focus:text-title-color dark:focus:text-dt-title-color focus:outline-none transition duration-150 ease-in-out" wire:click="$emit('closeModal')">
            {{ __('Cancelar') }}
        </button>
        <button type="submit" class="inline-block px-4 py-1.5 bg-edblue-600 text-white text-xxs leading-tight rounded shadow-md hover:bg-edblue-700 hover:shadow-lg focus:bg-edblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-edblue-800 active:shadow-lg transition duration-150 ease-in-out" wire:click="remove()">
            {{ __('Enviar invitación') }}
        </button>
    </div>
</div>
