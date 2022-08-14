@if ($data['class']->count() > 0)
    @foreach ($data['class'] as $index => $reg)
        <tr class="border-t border-border-color dark:border-edgray-700 hover:bg-gray-100 dark:hover:bg-dt-light-accent">
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->id }}
            </td>
            <td class="text-xs font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->getCreatedAtDate() }} - {{ $reg->getCreatedAtTime() }}
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <x-link class="text-edblue-500 dark:text-edblue-400 | hover:text-edblue-600 dark:hover:text-edblue-300 | focus:outline-none focus:text-edblue-600 dark:focus:text-edblue-300 | transition ease-in-out duration-150 | cursor-pointer" wire:click="applyUserFilter('{{ $reg->user->name }}')">
                    {{ $reg->user->name }}
                </x-link>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                <button class="text-xxxs uppercase inline-block w-24 py-1.5 px-2.5 leading-none font-medium rounded {{ $reg->public ? 'bg-edgray-400 text-edgray-900 dark:bg-edgray-600 dark:text-white' : 'bg-yellow-600 dark:bg-yellow-700 text-white' }}" wire:click="applyVisibilityFilter({{ $reg->public }})">
                    {{ $reg->public ? 'pública' : 'privada' }}
                </button>
            </td>
            <td class="text-sm font-light px-4 py-2.5 whitespace-nowrap">
                {{ $reg->title }}
            </td>
            <td class="font-light px-4 py-2.5 flex items-center space-x-1">
                <x-button-link color="edblue" class="group" title="Ver">
                    <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400" wire:click="view({{ $reg->id }})">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </x-button-link>
                <x-button-link color="edblue" class="group" title="Ver">
                    <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-edblue-500 dark:group-hover:border-edblue-400 | group-focus:border-edblue-500 dark:group-focus:border-edblue-400" wire:click="edit({{ $reg->id }})">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                </x-button-link>
                <x-button-link color="rose" class="group" title="Eliminar">
                    <span class="flex items-center justify-center rounded-full w-7 h-7 border | border-border-color dark:border-dt-border-color | group-hover:border-rose-500 dark:group-hover:border-rose-400 | group-focus:border-rose-500 dark:group-focus:border-rose-400" wire:click="remove({{ $reg->id }})">
                        <i class="fas fa-trash"></i>
                    </span>
                </x-button-link>
            </td>
        </tr>
    @endforeach
@else
    <tr class="border-t border-border-color dark:border-edgray-700">
        <td colspan="6" class="text-sm font-light px-4 py-4 whitespace-nowrap text-center">
            No se han encontrado resultados
        </td>
    </tr>
@endif
